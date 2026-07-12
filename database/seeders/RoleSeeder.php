<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create the 3 main roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Treasurer']); // Bendahara
        Role::create(['name' => 'Member']);    // Anggota biasa
    }
}
