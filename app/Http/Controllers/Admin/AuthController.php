<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Administrator;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private Administrator $administrator;

    public function __construct(Administrator $administrator)
    {
        $this->administrator = $administrator;
    }
    /**
     * サインインページ
     */
    public function signinView()
    {
        if (Auth::guard('administrators')->check()) {
            return redirect()->route('home');
        }
        return view('signin');
    }

    /**
     * サインイン（POST）
     */
    public function signin(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') ? true : false;

        if (Auth::guard('administrators')->attempt($credentials, $remember)) {
            return redirect()->route('home');
        } else {
            return $this->handleAuthenticationError($request);
        }
    }

    /**
     * サインインエラー処理
     */
    private function handleAuthenticationError($request)
    {
        $user = $this->administrator->findByEmail($request->email);
        if (!$user) {
            return redirect()->back()->withErrors(["email" => "メールアドレスが見つかりません"]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput($request->except('password'))->withErrors(["password" => "パスワードが誤っています"]);
        }

        return redirect()->back()->withErrors(["signup" => "認証エラーが発生しました"]);
    }

    /**
     * サインアップページ
     */
    public function signupView()
    {
        if (Auth::guard('administrators')->user()) {
            return redirect()->route('home');
        }
        return view('signup');
    }

    /**
     * サインアップ（POST）
     */
    public function signup(AuthRequest $request)
    {
        $req = $request->only(['name', 'email', 'password']);

        try {
            $res = $this->administrator->register($req);
            $credentials = $request->only(['email', 'password']);
            Auth::guard('administrators')->attempt($credentials);
            return redirect()->route('home');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                Log::error($e->getMessage());
                return redirect()->route("signup.view")->withErrors(["signup" => "メールアドレスは既に登録されています"]);
            }
            Log::error($e->getMessage());
            return redirect()->route("signup.view")->withErrors(["signup" => "サーバーエラーが発生しました"]);
        }
    }


    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウトしたらログインフォームにリダイレクト
        return redirect()->route('signin.view');
    }
}
