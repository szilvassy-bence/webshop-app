<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\User;
use App\Rules\CurrentAdminPassword;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use function Symfony\Component\String\b;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request): View
    {
        $search = $request->has('search') ? $request->get('search') : null;
        $orderBy = $request->has('orderBy') ? $request->get('orderBy') : 'id';

        $users = $this->userService->getUsers($search);

        return view('admin.users.index', ['users' => $users, 'search' => $search]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateProfile(User $user, UserProfileUpdateRequest $request): RedirectResponse
    {
        $user->fill($request->validated());

        if ($user->isDirty('email'))
        {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('admin.users.edit', ['user' => $user])->with('status', 'profile-updated');
    }

}
