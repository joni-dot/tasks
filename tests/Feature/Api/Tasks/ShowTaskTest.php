<?php

namespace Tests\Feature\Api\Tasks;

use App\Models\Task;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\CanSignIn;

class ShowTaskTest extends TestCase
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
    }

    /**
     * Send valid post request.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Testing\TestResponse
     */
    protected function validJsonGet(Task $task): TestResponse
    {
        return $this->json(
            method: 'get',
            uri: route('api.tasks.show', $task->id),
        );
    }

    /** @test */
    public function guest_cannot_show()
    {
        $this->validJsonGet(
            Task::factory()->create()
        )
            ->assertStatus(401);
    }

    /** @test */
    public function it_shows_task()
    {
        $this->signIn();

        $task = Task::factory()->create();

        $this->validJsonGet($task)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'name' => $task->name,
                ],
            ]);
    }
}
