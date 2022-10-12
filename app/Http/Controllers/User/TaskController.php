<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Auth::user()->tasks;
            return responseSuccess('', $tasks);
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->input();
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description']
            ]);
            Auth::user()->tasks()->attach($task->id);
            DB::commit();
            return responseSuccess('', $task->load('users'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return responseServerError($exception);
        }
    }

    public function delete(Task $task)
    {
        try {
            $task_users = $task->users;
            $user = Auth::user()->id;
            if ($task_users->contains('id', $user)) {
                $task->delete();
                return responseSuccess('تسک مورد نظر با موفقیت حذف شد', '');
            }
            return responseError('شما تنها قادر به حذف کردن تسک های خود هستید');
        } catch (\Exception $exception) {
            return responseServerError($exception);
        }
    }
}
