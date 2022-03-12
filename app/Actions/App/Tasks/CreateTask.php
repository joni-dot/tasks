<?php

namespace App\Actions\App\Tasks;

use App\Events\Tasks\TaskCreated;
use App\Models\Task;

class CreateTask
{
    /**
     * Create a task.
     *
     * @param  array  $params
     * @return \App\Models\Task
     */
    public function create(array $params)
    {
        TaskCreated::dispatch(
            Task::create($params)
        );
    }
}
