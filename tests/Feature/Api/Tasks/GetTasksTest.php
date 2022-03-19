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

    /** @test */
    public function it_can_paginate()
    {
        $this->signIn();

        $tasks = [
            Task::factory()->create(['name' => 'First']),
            Task::factory()->create(['name' => 'Second']),
        ];

        $this->validJsonGet([
            'page' => [
                'size' => 1,
                'number' => 2,
            ],
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $tasks[1]->id,
                        'name' => $tasks[1]->name,
                    ],
                ],
            ])
            ->assertJsonMissing([
                'data' => [
                    [
                        'id' => $tasks[0]->id,
                        'name' => $tasks[0]->name,
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_filter_by_name()
    {
        $this->signIn();

        $tasks = [
            Task::factory()->create(['name' => 'First']),
            Task::factory()->create(['name' => 'Second']),
        ];

        $this->validJsonGet([
            'filter' => [
                'name' => 'second',
            ],
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $tasks[1]->id,
                        'name' => $tasks[1]->name,
                    ],
                ],
            ])
            ->assertJsonMissing([
                'data' => [
                    [
                        'id' => $tasks[0]->id,
                        'name' => $tasks[0]->name,
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_sort_by_name_desc()
    {
        $this->signIn();

        $tasks = [
            Task::factory()->create(['name' => 'First']),
            Task::factory()->create(['name' => 'Second']),
        ];

        $this->validJsonGet([
            'sort' => '-name',
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $tasks[1]->id,
                        'name' => $tasks[1]->name,
                    ],
                    [
                        'id' => $tasks[0]->id,
                        'name' => $tasks[0]->name,
                    ],
                ],
            ]);
    }
}
