<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Task::all();
            return responseSuccess('', $tasks);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }

    public function update(Request $request, Task $task)
    {
        try {
            $data = $request->input();
            $task->update($data);
            return responseSuccess('', $task);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }

    public function delete(Task $task)
    {
        try {
            $task->delete();
            return responseSuccess('', null);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }

    public function join(Task $task)
    {
        $user = Auth::user()->id;
//        $task->users->attach($user);
        return $task->users;
    }
}
