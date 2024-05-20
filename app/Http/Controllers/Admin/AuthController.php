<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::guard('administrators')->user()) {
            return redirect()->route('admin.dashboard.index');
        }
        return view('admin.login');
    }

    public function login(AdminAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') ? true : false;

        // dd($credentials);
        if (Auth::guard('administrators')->attempt($credentials, $remember)) {
            return redirect()->route('admin.dashboard.index');
        } else {
            return back()->withErrors([
                'login' => ['ログインに失敗しました'],
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウトしたらログインフォームにリダイレクト
        return redirect()->route('admin.login.index');
    }
}
