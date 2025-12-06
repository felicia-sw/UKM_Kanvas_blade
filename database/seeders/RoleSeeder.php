<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

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