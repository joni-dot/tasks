<?php

namespace Tests\Feature\Api\Tasks;

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
    protected function validJsonDelete(Task $task): TestResponse
    {
        return $this->json(
            method: 'delete',
            uri: route('api.tasks.delete', $task->id),
        );
    }

    /** @test */
    public function guest_cannot_delete()
    {
        $this->validJsonDelete(
            $task = Task::factory()->create()
        )
            ->assertStatus(401);

        $this->assertDatabaseHas(Task::tableName(), [
            'id' => $task->id,
        ]);
    }

    /** @test */
    public function it_deletes_task()
    {
        $this->signIn();

        $this->validJsonDelete(
            $task = Task::factory()->create()
        )
            ->assertStatus(200);

        $this->assertDatabaseMissing(Task::tableName(), [
            'id' => $task->id,
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        $this->signIn();

        $this->validJsonDelete(
            Task::factory()->create()
        )
            ->assertStatus(200);

        Event::assertDispatched(TaskDeleted::class);
    }
}
