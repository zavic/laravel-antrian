<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class UserProfileController extends Controller
{
    public function index()
    {
        $token = null;
        $user = auth()->user();

        return view('pages.user.user-profile', compact('user', 'token'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required | min:1 | max:255',
            'email' => 'required | min:1 | max:255',
            'phone' => 'required | numeric | digits_between:9,15',
            'address' => 'required | min:1 | max:255',
        ]);

        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $user->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]
        );

        return redirect()->route('user-profile')->with('success', 'Profil anda Berhasil Diperbaharui');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password_old' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_old, $user->password)) {
            return back()->withErrors(['password_old' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Kata Sandi anda berhasil diubah!');
    }


}
