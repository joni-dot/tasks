<?php

namespace Tests\Feature\Web\Tasks;

use App\Events\Tasks\TaskDeleted;
use App\Models\Task;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\CanSignIn;

class DeleteTaskTest extends TestCase
{
    use CanSignIn;

    /**
     * Setup test.
     *
     * @return  void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

    /**
     * Send valid delete request.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Testing\TestResponse
     */
    protected function validDelete(Task $task): TestResponse
    {
        return $this->delete(
            uri: route('tasks.delete', $task->id),
        );
    }

    /** @test */
    public function guest_cannot_delete()
    {
        $this->validDelete(
            $task = Task::factory()->create()
        )
            ->assertStatus(302);

        $this->assertDatabaseHas(Task::tableName(), [
            'id' => $task->id,
        ]);
    }

    /** @test */
    public function it_deletes_task()
    {
        $this->signIn();

        $this->validDelete(
            $task = Task::factory()->create()
        )
            ->assertStatus(302);

        $this->assertDatabaseMissing(Task::tableName(), [
            'id' => $task->id,
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        $this->signIn();

        $this->validDelete(
            Task::factory()->create()
        )
            ->assertStatus(302);

        Event::assertDispatched(TaskDeleted::class);
    }
}
