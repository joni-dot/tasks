<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->enforceMorphMap();
    }

    /**
     * Force system to use specific morph maps with polymorphic relationships.
     *
     * @return  void
     */
    protected function enforceMorphMap(): void
    {
        Relation::enforceMorphMap([
            'task' => Task::class,
            'user' => User::class,
        ]);
    }
}
