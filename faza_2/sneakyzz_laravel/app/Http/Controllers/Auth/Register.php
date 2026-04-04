<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function showForm(){
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email',
            'pname' => 'required|string|max:15',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'          => $request->fname,
            'surname'       => $request->lname,
            'email'         => $request->email,
            'phone_num'     => $request->pname,
            'password_hash' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

}
