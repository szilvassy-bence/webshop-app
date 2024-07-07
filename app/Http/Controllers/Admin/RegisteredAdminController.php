<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredAdminController extends Controller
{
    public function create() {
        return view('admin.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        Admin::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'status' => 0
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
            ])
        )
        {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return back()->withErrors('Invalid Email or Password');
        }
    }
}
