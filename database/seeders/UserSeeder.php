<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fetch the Admin Role from DB
        $adminRole = Role::where('name', 'Admin')->first();
        $memberRole = Role::where('name', 'Member')->first();

        // 2. Create YOUR Admin Account
        $admin = User::create([
            'name' => 'Admin Kanvas',
            'email' => 'admin@gmail.com', // <--- Login Email
            'password' => Hash::make('adminKanvas123'), // <--- Login Password
            'email_verified_at' => now(),
        ]);

        // 3. Assign Role & Create Profile
        $admin->roles()->attach($adminRole);

        Profile::create([
            'user_id' => $admin->id,
            'nim' => '00000000',
            'jurusan' => 'Sistem Informasi',
            'asal_universitas' => 'Universitas Kanvas',
            'no_telp' => '081234567890',
        ]);

        // 4. Create a Dummy Student (Member) for testing
        $student = User::create([
            'name' => 'Felicia Student',
            'email' => 'student@kanvas.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $student->roles()->attach($memberRole);

        Profile::create([
            'user_id' => $student->id,
            'nim' => '202510001',
            'jurusan' => 'Desain Komunikasi Visual',
            'asal_universitas' => 'Universitas Kanvas',
            'no_telp' => '08987654321',
        ]);
    }
}
