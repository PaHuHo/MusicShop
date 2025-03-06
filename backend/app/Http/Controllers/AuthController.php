<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('login', ['fail' => false]);
    }
    public function storeLogin(Request $request){
        $remember = $request->boolean('rememberCheck');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'is_delete'=>0,'is_active'=>1], $remember)) {
            $user = User::find(Auth::id());
            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
            ]);
            return redirect()->route('product-page');
        } else {
            return view('login', ['fail' => true]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
