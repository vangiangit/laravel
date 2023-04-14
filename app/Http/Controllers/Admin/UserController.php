<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\UseService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        else
            return view('admin.user.login');
    }

    public function loginStore(Request $request)
    {
        if (Auth::attempt([
            'name' => $request->input('username'),
            'password' => $request->input('password'),
        ], false)) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin-login');;
    }
}
