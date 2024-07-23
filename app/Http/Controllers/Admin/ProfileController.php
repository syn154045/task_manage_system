<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editView()
    {
        $admin = Auth::guard('administrators')->user();
        return view('profile/edit', compact('admin'));
    }

    /**
     * profile update
     */
    public function update(ProfileRequest $request)
    {
        /** @var \App\Models\Administrator $admin */
        $admin = Auth::guard('administrators')->user();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->save();

        return redirect()->route('profile.edit.view')->with(['message' => 'アカウント情報を更新しました']);
    }

    /**
     * password update
     */
    public function passwordUpdate(ProfileRequest $request)
    {
        /** @var \App\Models\Administrator $admin */
        $admin = Auth::guard('administrators')->user();
        $admin->password = Hash::make($request->get('password'));
        $admin->save();

        return redirect()->route('profile.edit.view')->with(['message' => 'パスワードを変更しました']);
    }

    public function deleteView()
    {
        return view('profile/delete');
    }

    public function userManageView()
    {
        return view('profile/userManage');
    }
}
