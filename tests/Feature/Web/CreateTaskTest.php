<?php

namespace Tests\Feature\Web\Tasks;

use App\Events\Tasks\TaskCreated;
use App\Models\Task;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\CanSignIn;

class CreateTaskTest extends TestCase
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
     * Send valid post request.
     *
     * @param  array  $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function validPost(array $data = []): TestResponse
    {
        return $this->post(
            uri: route('tasks.create'),
            data: array_merge([
                'name' => 'TestName',
            ], $data)
        );
    }

    /** @test */
    public function guest_cannot_create()
    {
        $this->validPost([
            'name' => 'GuestTask',
        ])
            ->assertStatus(401);

        $this->assertDatabaseMissing(Task::tableName(), [
            'name' => 'GuestTask',
        ]);
    }

    /** @test */
    public function it_creates_task()
    {
        $this->signIn();

        $this->validPost([
            'name' => 'SomeTestName',
        ])
            ->assertStatus(200);

        $this->assertDatabaseHas(Task::tableName(), [
            'name' => 'SomeTestName',
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        $this->signIn();

        $this->validPost()->assertStatus(200);

        Event::assertDispatched(TaskCreated::class);
    }
}
