<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login', ['fail' => false]);
    }
    public function storeLogin(Request $request)
    {
        $remember = $request->boolean('rememberCheck');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => 0, 'is_active' => 1], $remember)) {
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

    public function loginCustomer(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('customer')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logoutCustomer()
    {
        //JWTAuth::invalidate(JWTAuth::getToken());
        auth()->guard('customer')->logout();
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Customer logged out'], 200);
    }

    public function getCustomer(Request $request)
    {
        try {
            // Lấy token từ request
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json(['error' => 'No token provided'], 401);
            }

            // Kiểm tra token có hợp lệ không
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'Invalid token'], 401);
            }

            return response()->json($user);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token error'], 401);
        }
    }
}
