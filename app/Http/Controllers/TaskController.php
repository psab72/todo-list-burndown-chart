<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Task;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return $this->user->tasks;
    }

    public function logCurrentStatus($request, $isNewTask = false)
    {
        $countCompleted = $request->statuses['completed'];
        $countPending = $request->statuses['pending'];

        if ($isNewTask) {
            $countPending += 1;
        } else {
            if ($request->item['status']) {
                $countCompleted -= ($request->statuses['completed'] > 0 ? 1 : 0);
                $countPending += 1;
            } else {
                $countCompleted += 1;
                $countPending -= $request->statuses['pending'] >0 ? 1 : 0;
            }
        }

        $activity = $this->user->activities()->create([
            'pending_tasks' => $countPending,
            'completed_tasks' => $countCompleted
        ]);

        return $activity;
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item.task' => 'required',
            'item.status' => 'required|boolean'
        ]);
        // Create a new task
        $task = $this->user->tasks()->create([
            'task' => $request->item['task'],
            'status' => $request->item['status']
        ]);

        // Log current status
        $activity = $this->logCurrentStatus($request, true);

        return [
            'task_item' => $task,
            'user_activity' => $activity
        ];
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'item.task' => 'required',
            'item.status' => 'boolean',
            'item.user_id' => Rule::in([$this->user->id])
        ]);

        $task = Task::find($id);
        $task->task = $request->item['task'];
        $task->status = $request->item['status'];
        $task->save();

        return $task;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function toggleStatus(Request $request, $id)
    {
        $this->validate($request, [
            'item.status' => 'required|boolean',
            'item.user_id' => Rule::in([$this->user->id]),
            'statuses.pending' => 'required|numeric',
            'statuses.completed' => 'required|numeric'
        ]);

        // Update task status
        $task = Task::find($id);
        $task->status = ! $request->item['status'];
        $task->save();

        // Log user statuses
        $activity = $this->logCurrentStatus($request);

        return [
            'task_item' => $task,
            'user_activity' => $activity
        ];
    }


}
