<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.user.login');
    }

    public function loginStore(Request $request)
    {
        dump($request->input());
    }
}
