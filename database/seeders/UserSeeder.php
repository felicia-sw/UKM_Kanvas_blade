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

        // 2. Create YOUR Admin Account (only if it doesn't exist)
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Kanvas',
                'password' => Hash::make('adminKanvas123'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Assign Role & Create Profile (if not exists)
        if (!$admin->roles()->where('role_id', $adminRole->id)->exists()) {
            $admin->roles()->attach($adminRole);
        }

        // Update or create profile, avoiding NIM conflict by using user_id first
        $existingProfile = Profile::where('user_id', $admin->id)->first();
        if ($existingProfile) {
            $existingProfile->update([
                'nim' => '00000000',
                'jurusan' => 'Sistem Informasi',
                'asal_universitas' => 'Universitas Kanvas',
                'no_telp' => '081234567890',
            ]);
        } else {
            // Delete any profile with this NIM if it belongs to a different user
            Profile::where('nim', '00000000')->where('user_id', '!=', $admin->id)->delete();
            Profile::create([
                'user_id' => $admin->id,
                'nim' => '00000000',
                'jurusan' => 'Sistem Informasi',
                'asal_universitas' => 'Universitas Kanvas',
                'no_telp' => '081234567890',
            ]);
        }

        // 4. Create a Dummy Student (Member) for testing (only if it doesn't exist)
        $student = User::firstOrCreate(
            ['email' => 'student@kanvas.com'],
            [
                'name' => 'Felicia Student',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if (!$student->roles()->where('role_id', $memberRole->id)->exists()) {
            $student->roles()->attach($memberRole);
        }

        $existingStudentProfile = Profile::where('user_id', $student->id)->first();
        if ($existingStudentProfile) {
            $existingStudentProfile->update([
                'nim' => '202510001',
                'jurusan' => 'Desain Komunikasi Visual',
                'asal_universitas' => 'Universitas Kanvas',
                'no_telp' => '08987654321',
            ]);
        } else {
            Profile::where('nim', '202510001')->where('user_id', '!=', $student->id)->delete();
            Profile::create([
                'user_id' => $student->id,
                'nim' => '202510001',
                'jurusan' => 'Desain Komunikasi Visual',
                'asal_universitas' => 'Universitas Kanvas',
                'no_telp' => '08987654321',
            ]);
        }
    }
}
