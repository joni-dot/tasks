<?php

namespace Tests\Feature\Api\Tasks;

use App\Models\Task;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\CanSignIn;

class GetTasksTest extends TestCase
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
     * @param  array  $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function validJsonGet(array $data = []): TestResponse
    {
        return $this->json(
            method: 'get',
            uri: route('api.tasks.index'),
            data: $data
        );
    }

    /** @test */
    public function guest_cannot_get()
    {
        $this->validJsonGet()->assertStatus(401);
    }

    /** @test */
    public function it_get_tasks()
    {
        $this->signIn();

        $task = Task::factory()->create();

        $this->validJsonGet()
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $task->id,
                        'name' => $task->name,
                    ],
                ],
            ]);
    }
}
