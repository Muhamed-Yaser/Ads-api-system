<?php

namespace App\Services\AdminServices;

use Illuminate\Support\Facades\Auth;


class AdminAuthService
{

    public function loginAdmin($request)
    {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            session()->regenerate();
            return redirect()->route('Dashboard.index');
        } else {

            return redirect()->back()->withErrors(['email' => 'الميل غير صحيح', 'password' => 'الباس غير صحيح']);
        }
    }

    public function checkAuthenticated()
    {
        if (!auth()->guard('admin')->check()) {

            return redirect()->route('auth.login');
        }
    }

    public function profileAdmin()
    {
        $this->checkAuthenticated();
        return view('Dashboard.Profile.profile');
    }

    public function editProfileAdmin()
    {
        $admin = auth()->guard('admin')->user();
        return view('Dashboard.Profile.editProfile', compact('admin'));
    }

    public function updateProfileAdmin($request)
    {
        auth()->guard('admin')->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('profile');
    }

    public function logout ()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('loginPage');
    }
}