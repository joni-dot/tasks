<?php

namespace Tests\Unit\Actions\Tasks;

use App\Actions\App\Tasks\CreateTask;
use App\Events\Tasks\TaskCreated;
use App\Models\Task;
use Illuminate\Support\Facades\Event;
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

        Event::fake();

        (new CreateTask)->create([
            'name' => 'TestName',
        ]);
    }

    /** @test */
    public function it_creates_task()
    {
        $this->assertDatabaseHas(Task::tableName(), [
            'name' => 'TestName',
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        Event::assertDispatched(TaskCreated::class);
    }
}
