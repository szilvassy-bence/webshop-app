<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
class UserService
{
    public function getUsers(string $search = null): Collection
    {
        if (!$search) {
            $users = User::orderBy('id', 'asc')->get();
        } else {
            $users = $this->search($search);
        }

        return $users;
    }

    private function search(string $search): Collection
    {
        $results = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
            ->get();

        return $results;
    }
}
