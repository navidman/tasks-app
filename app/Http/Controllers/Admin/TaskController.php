<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public function index()
    {

        try {
            $tasks = Task::all();
            return responseSuccess('', $tasks);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }

    public function update(TaskRequest $request, Task $task)
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
        try {
            $user = Auth::user()->id;
            $task->users()->attach($user);
            return responseSuccess('', $task->users);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }
}
