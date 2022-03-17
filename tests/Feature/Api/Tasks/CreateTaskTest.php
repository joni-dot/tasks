<?php

namespace Tests\Feature\Api\Tasks;

use App\Events\Tasks\TaskCreated;
use App\Models\Task;
use App\Models\User;
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
    }

    /** @test */
    public function it_creates_task()
    {
        $this->actingAs(User::factory()->create());

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
        $this->actingAs(User::factory()->create());

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
