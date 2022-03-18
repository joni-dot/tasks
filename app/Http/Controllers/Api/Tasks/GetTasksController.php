<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class GetTasksController extends Controller
{
    /**
     * Get tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return TaskResource::collection(
            Task::query()->take(15)->get()
        );
    }
}
