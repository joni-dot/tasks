<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Redirect;

class StoreTaskController extends Controller
{
    /**
     * List tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        Task::create(request()->all());

        return Redirect::route('tasks.index');
    }
}
