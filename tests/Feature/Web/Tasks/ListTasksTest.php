<?php

namespace Tests\Feature\Web\Tasks;

use App\Models\Task;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use Tests\Traits\CanSignIn;

class ListTasksTest extends TestCase
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
     * Send valid get request.
     *
     * @param  array  $parameters
     * @return \Illuminate\Testing\TestResponse
     */
    protected function validGet(array $parameters = []): TestResponse
    {
        return $this->get(
            uri: route(
                name: 'tasks.index',
                parameters: $parameters
            ),
        );
    }

    /** @test */
    public function guest_cannot_list()
    {
        $this->validGet()->assertStatus(302);
    }

    /** @test */
    public function it_can_list()
    {
        $this->signIn();

        Task::factory()
            ->count(2)
            ->create();

        $this->validGet()
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Tasks/Index')
                ->has('tasks')
            );
    }
}
