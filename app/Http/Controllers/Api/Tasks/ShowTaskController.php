<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class ShowTaskController extends Controller
{
    /**
     * Get specific task information.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Task $task)
    {
        return new TaskResource($task);
    }
}
