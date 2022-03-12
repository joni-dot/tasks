<?php

namespace App\Actions\App\Tasks;

use App\Models\Task;

class DeleteTask
{
    /**
     * Delete specific task.
     *
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
