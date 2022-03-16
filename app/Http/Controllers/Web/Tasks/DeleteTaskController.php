<?php

namespace App\Http\Controllers\Web\Tasks;

use App\Actions\App\Tasks\DeleteTask;
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
        (new DeleteTask)->delete($task);

        return Redirect::route('tasks.index');
    }
}
