<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ListTasksController extends Controller
{
    /**
     * List tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return Inertia::render('Tasks/Index');
    }
}
