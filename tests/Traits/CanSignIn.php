<?php

namespace Tests\Traits;

use App\Models\User;

trait CanSignIn
{
    public function signIn()
    {
        $this->actingAs(User::factory()->create());
    }
}
