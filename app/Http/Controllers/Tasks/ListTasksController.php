<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
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
        return Inertia::render('Tasks/Index', [
            'tasks' => Task::query()
                ->latest('id')
                ->paginate(15)
                ->withQueryString()
                ->through(fn ($organization) => [
                    'id' => $organization->id,
                    'name' => $organization->name,
                ]),
        ]);
    }
}
