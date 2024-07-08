<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Rules\CurrentAdminPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', [
            'admin' => Auth::guard('admin')->user()
        ]);
    }

    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();
        $admin->fill($request->validated());


        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null;
        }

        $admin->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', new CurrentAdminPassword()]
        ]);

        $admin = Auth::guard('admin')->user();

        Auth::guard('admin')->logout();

        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('admin.login.create')->with('status', 'profile-deleted');
    }
}
