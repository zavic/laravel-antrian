<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.user.list-user');
    }

    public function create()
    {
        return view('pages.admin.user.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required | min:1 | max:255',
            'name' => 'required | min:1 | max:255',
            'email' => 'required | string | email | min:1 | max:255 | unique:users',
            'password' => 'required | min:8',
            'phone' => 'required | numeric | digits_between:9,15 | unique:users',
            'address' => 'required | string | min:1 | max:255',
        ]);

        // return dd($validate);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user-list')->with('success', 'User Berhasil Dibuat');
    }
}
