<?php

namespace Tests\Unit\Actions;

use App\Actions\App\Tasks\CreateTask;
use App\Models\Task;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    /**
     * Setup test.
     *
     * @return  void
     */
    protected function setUp(): void
    {
        parent::setUp();

        (new CreateTask)->create([
            'name' => 'TestName',
        ]);
    }

    /** @test */
    public function it_creates_task()
    {
        $this->assertDatabaseHas((new Task)->getTable(), [
            'name' => 'TestName',
        ]);
    }
}
