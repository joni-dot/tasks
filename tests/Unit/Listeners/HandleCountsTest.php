<?php

namespace Tests\Unit\Actions\Tasks;

use App\Actions\App\Tasks\CreateTask;
use App\Models\Count;
use App\Models\Task;
use Tests\TestCase;

class HandleCountsTest extends TestCase
{
    /**
     * Setup test.
     *
     * @return  void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_counts_when_increased()
    {
        (new CreateTask)->create([
            'name' => 'TestName',
        ]);

        $this->assertDatabaseHas((new Count)->getTable(), [
            'countable_type' => (new Task)->getMorphClass(),
            'count' => 1,
        ]);
    }
}
