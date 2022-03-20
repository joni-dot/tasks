<?php

namespace App\Listeners;

use App\Models\Count;
use Illuminate\Support\Str;
use ReflectionClass;

class HandleCounts
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function handle(mixed $event): void
    {
        if (Str::endsWith(
            haystack: $event::class,
            needles: 'Created')) {
            $this->increaseCount($event);
        }

        if (Str::endsWith(
            haystack: $event::class,
            needles: 'Deleted')) {
            $this->decreaseCount($event);
        }
    }

    /**
     * Increase count.
     *
     * @param  mixed  $event
     * @return void
     */
    protected function increaseCount(mixed $event): void
    {
        $count = Count::firstOrCreate([
            'countable_type' => strtolower(
                Str::before(
                    subject: (new ReflectionClass($event))->getShortName(),
                    search: 'Created'
                ),
            ),
        ]);

        $count->update([
            'count' => $count->count + 1,
        ]);
    }

    /**
     * Decrease count.
     *
     * @param  mixed  $event
     * @return void
     */
    protected function decreaseCount(mixed $event): void
    {
        $count = Count::firstOrCreate([
            'countable_type' => strtolower(
                Str::before(
                    subject: (new ReflectionClass($event))->getShortName(),
                    search: 'Deleted'
                ),
            ),
        ]);

        $count->update([
            'count' => $count->count - 1,
        ]);
    }
}
