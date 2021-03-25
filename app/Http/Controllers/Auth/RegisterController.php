<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $user = User::create($request->except('password') + [
            'password' => Hash::make($request->password)
        ]);
        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('index');
    }
}
