<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Redirect;

class DeleteTaskController extends Controller
{
    /**
     * Delete task.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Task $task)
    {
        $task->delete();

        return Redirect::route('tasks.index');
    }
}
