<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Foundation\Validation\ValidatesRequests;
class UpdateProfileController extends Controller implements HasMiddleware
{
    use ValidatesRequests;
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }
    public function __construct()
    {
        $this->middleware();
    }
    public function editProfile(User $user)
    {
        $user = Auth::user();
        return view('auth.editprofile', compact('user'));
    }

    public function updateProfile(User $user)
    {
        if (Auth::user()->email == request('email')) {
            $this->validate(request(), [
                'name' => 'required',
                //  'email' => 'required|email|unique:users',
            ]);
            $user->name = request('name');
            // $user->email = request('email');
            $user->save();
            return back()->withSuccess('Password change successfully.');
        } else {
            $this->validate(request(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                //'password' => 'required|min:6|confirmed'
            ]);

            $user->name = request('name');
            $user->email = request('email');
            //$user->password = bcrypt(request('password'));

            $user->save();
            return back()->withSuccess('Password change successfully.');
        }
    }
}
