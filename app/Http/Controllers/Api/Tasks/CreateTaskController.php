<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Actions\App\Tasks\CreateTask;
use App\Http\Controllers\Controller;

class CreateTaskController extends Controller
{
    /**
     * List tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        (new CreateTask)->create(request()->all());
    }
}
