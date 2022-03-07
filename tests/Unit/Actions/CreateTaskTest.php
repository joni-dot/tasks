<?php

namespace Tests\Unit\Actions;

use App\Actions\App\Tasks\CreateTask;
use App\Events\TaskCreated;
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
        $this->assertDatabaseHas((new Task)->getTable(), [
            'name' => 'TestName',
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        Event::assertDispatched(TaskCreated::class);
    }
}
