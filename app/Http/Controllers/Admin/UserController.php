<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public function index()
    {
        try {
            $users = User::all();
            return responseSuccess('', $users);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }
}
