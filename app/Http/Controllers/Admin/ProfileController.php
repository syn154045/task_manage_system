<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Administrator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

    /**
     * account soft-delete
     */
    public function delete(Request $request)
    {
        /** @var \App\Models\Administrator $admin */
        $admin = Auth::guard('administrators')->user();
        $admin->delete();

        return redirect()->route('profile.edit.view')->with(['message' => '削除しました']);
    }


    public function authManageView()
    {
        $users = Administrator::select('id', 'name', 'email', 'role')
        ->whereNull('deleted_at')
        ->get();
        return view('profile/authManage', compact('users'));
    }

    /**
     * user authority change
     */
    public function authUpdate(Request $request)
    {
        // dd($request);
        $allIds = $request->input('admin_ids', []);

        $superIds = $request->input('super_ids', []);
        $adminIds = array_diff($allIds, $superIds);

        try {
            DB::beginTransaction();
            // role change to super
            Administrator::whereIn('id', $superIds)->update(['role' => 'super']);
            // role change to admin
            Administrator::whereIn('id', $adminIds)->update(['role' => 'admin']);
            DB::commit();

            return redirect()->back()->with(['message' => '権限変更完了しました']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['err' => '権限変更に失敗しました']);
        }
    }
}
