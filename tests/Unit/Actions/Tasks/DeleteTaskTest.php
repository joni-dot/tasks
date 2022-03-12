<?php

namespace Tests\Unit\Actions\Tasks;

use App\Actions\App\Tasks\DeleteTask;
use App\Events\Tasks\TaskDeleted;
use App\Models\Task;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    /** @var \App\Models\Task */
    protected Task $deletableTask;

    /**
     * Setup test.
     *
     * @return  void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        (new DeleteTask)->delete(
            $this->deletableTask = Task::factory()->create(),
        );
    }

    /** @test */
    public function it_deletes_task()
    {
        $this->assertDatabaseMissing((new Task)->getTable(), [
            'id' => $this->deletableTask,
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        Event::assertDispatched(TaskDeleted::class);
    }
}
