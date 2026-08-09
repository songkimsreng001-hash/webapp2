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
        $totalCategories = DB::table('categories')->count();
        $totalRevenue    = Order::where('status', 2)->sum('amount'); // Paid only

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
            'totalCategories',
            'totalRevenue',
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
}