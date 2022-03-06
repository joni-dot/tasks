<?php

namespace Tests\Unit\Actions;

use App\Actions\App\Tasks\CreateTask;
use App\Models\Task;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        (new CreateTask)->create([
            'name' => 'TestName',
        ]);

        $this->assertDatabaseHas((new Task)->getTable(), [
            'name' => 'TestName',
        ]);
    }
}
