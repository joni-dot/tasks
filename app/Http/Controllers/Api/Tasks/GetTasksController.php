<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;

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
            QueryBuilder::for(Task::class)
                ->allowedFilters(['name'])
                ->allowedSorts(['name'])
                ->jsonPaginate()
        );
    }
}
