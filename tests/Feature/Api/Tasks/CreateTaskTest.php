<?php

namespace Tests\Feature\Api\Tasks;

use App\Events\Tasks\TaskCreated;
use App\Models\Task;
use Illuminate\Support\Facades\Event;
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

    /** @test */
    public function it_creates_task()
    {
        $this->signIn();

        $this->json(
            method: 'post',
            uri: route('api.tasks.create'),
            data: [
                'name' => 'TestName',
            ]
        )
            ->assertStatus(200);

        $this->assertDatabaseHas(Task::tableName(), [
            'name' => 'TestName',
        ]);
    }

    /** @test */
    public function it_dispatches_event()
    {
        $this->signIn();

        $this->json(
            method: 'post',
            uri: route('api.tasks.create'),
            data: [
                'name' => 'TestName',
            ]
        )
            ->assertStatus(200);

        Event::assertDispatched(TaskCreated::class);
    }
}
