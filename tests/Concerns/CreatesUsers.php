<?php

namespace Tests\Concerns;

use App\Models\Role;
use App\Models\User;

trait CreatesUsers
{
    protected function makeAdmin(): User
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::firstOrCreate(['name' => 'Admin']));

        return $user;
    }

    protected function makeMember(): User
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::firstOrCreate(['name' => 'Member']));

        return $user;
    }
}
