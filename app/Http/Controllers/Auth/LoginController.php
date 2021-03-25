<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if(!auth()->attempt($request->only('email', 'password'), $request->remmember)) {
            return redirect()->route('index');
        }
        return redirect()->route('questions');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }
}
