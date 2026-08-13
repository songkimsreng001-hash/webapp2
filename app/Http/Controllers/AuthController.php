<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $remember    = $request->has('remember');
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard')->withSuccess('Welcome back!');
            }

            return redirect()->intended('/')->withSuccess('Welcome back!');
        }

        return redirect('login')->withErrors('Invalid email or password.');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);

        $this->create($request->all());

        return redirect('/login')->withSuccess('Account created! Please log in.');
    }

    public function dashboard()
    {
        if (! Auth::check()) {
            return redirect('login')->withErrors('You do not have access!');
        }

        $user = Auth::user();

        // Latest products for table
        $products = Product::with('category')
                           ->orderBy('created_at', 'desc')
                           ->take(12)
                           ->get();

        // Stat card counts
        $totalProducts   = Product::count();
        $totalOrders     = Order::count();
        $totalCustomers  = User::count();
        $totalCategories = DB::table('categories')->count();
        $totalRevenue    = Order::where('status', 2)->sum('amount'); // Paid only

        $startOfWeek = now()->subDays(6)->startOfDay();
        $dailyRevenue = Order::whereBetween('created_at', [$startOfWeek, now()->endOfDay()])
            ->selectRaw('DATE(created_at) as order_date, SUM(amount) as revenue')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('order_date')
            ->map(fn ($row) => (float) $row->revenue);

        $weeklySales = collect(range(0, 6))->map(function ($offset) use ($startOfWeek, $dailyRevenue) {
            $date = $startOfWeek->copy()->addDays($offset);
            $key  = $date->format('Y-m-d');

            return [
                'day'     => $date->format('D'),
                'short'   => $date->format('D'),
                'revenue' => (float) ($dailyRevenue[$key] ?? 0),
            ];
        });
        $weeklyMax = max($weeklySales->max('revenue') ?? 0, 0);

        // Top products by units sold
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->groupBy('products.name')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        // Order status breakdown for donut
        $approvedOrders = Order::where('status', 1)->count();
        $pendingOrders  = Order::where('status', 2)->count(); // Paid = pending shipment
        $rejectedOrders = Order::where('status', 0)->count();

        // Recent orders for team collaboration panel
        $recentOrders = Order::with('user')
                             ->orderBy('created_at', 'desc')
                             ->take(5)
                             ->get();

        return view('auth.dashboard', compact(
            'user',
            'products',
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalCategories',
            'totalRevenue',
            'weeklySales',
            'weeklyMax',
            'topProducts',
            'approvedOrders',
            'pendingOrders',
            'rejectedOrders',
            'recentOrders',
        ));
    }

    public function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'] ?? 'user',
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login')->withSuccess('You have been logged out.');
    }

    /**
     * Redirect the user to the Google OAuth page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $email = $googleUser->getEmail();

            if (! $email) {
                return redirect('/login')->withErrors('Unable to retrieve email from Google.');
            }

            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? $email,
                'password' => Hash::make(Str::random(24)),
                'role' => 'user',
            ]);

            Auth::login($user, true);

            return redirect()->intended('/')->withSuccess('Logged in with Google.');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Google login failed.');
        }
    }
}