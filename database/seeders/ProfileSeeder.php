<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // UserSeeder already creates profiles for the accounts it seeds.
        // Only fill in users that still lack one, so re-running db:seed
        // neither fails on the unique nim nor gives users a second profile.
        $users = User::doesntHave('profile')->get();
        $i = 0;
        foreach ($users as $user) {
            $i++;
            Profile::create([
                'user_id' => $user->id,
                'nim' => '123456789'.$i,
                'jurusan' => 'Informatics',
                'asal_universitas' => 'University of Example',
                'no_telp' => '08123456789'.$i,
            ]);
        }
    }
}
