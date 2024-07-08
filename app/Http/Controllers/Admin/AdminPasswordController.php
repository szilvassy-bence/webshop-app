<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Rules\CurrentAdminPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminPasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', new CurrentAdminPassword()],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        Auth::guard('admin')->user()->update(['password' => Hash::make($validated['password'])]);

        return back()->with(['status' => 'password-updated']);
    }
}
