<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
class RegisteredAdminController extends Controller
{
    public function create() {
        return view('admin.register');
    }
}
