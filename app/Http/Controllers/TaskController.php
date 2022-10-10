<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function test()
    {
        return Task::find(1)->with('users')->get();
    }
}
