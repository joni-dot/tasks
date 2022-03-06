<?php

namespace App\Http\Controllers\Tasks;

use App\Actions\App\Tasks\CreateTask;
use App\Http\Controllers\Controller;
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
        (new CreateTask)->create(request()->all());

        return Redirect::route('tasks.index');
    }
}
