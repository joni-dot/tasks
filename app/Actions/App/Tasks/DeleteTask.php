<?php

namespace App\Actions\App\Tasks;

use App\Events\Tasks\TaskDeleted;
use App\Models\Task;

class DeleteTask
{
    /**
     * Delete specific task.
     *
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function delete(Task $task): Task
    {
        TaskDeleted::dispatch(
            $deletedTask = tap($task)->delete()
        );

        return $deletedTask;
    }
}
