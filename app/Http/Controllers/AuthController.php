<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function auth(Request $request)
    {
        $validate = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (auth()->attempt($validate)) {
                return redirect('/index');
        }
        // Alert::error('Peringatan', 'Username atau Password salah');
        return redirect('/');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
