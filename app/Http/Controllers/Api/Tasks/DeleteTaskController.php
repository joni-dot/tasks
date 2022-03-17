<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Actions\App\Tasks\DeleteTask;
use App\Http\Controllers\Controller;
use App\Models\Task;

class DeleteTaskController extends Controller
{
    /**
     * Delete task.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Task $task)
    {
        (new DeleteTask)->delete($task);
    }
}
