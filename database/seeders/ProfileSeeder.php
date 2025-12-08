<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $i = 0;
        foreach ($users as $user) {
            $i++;
            Profile::create([
                'user_id' => $user->id,
                'nim' => '123456789' . $i,
                'jurusan' => 'Informatics',
                'asal_universitas' => 'University of Example',
                'no_telp' => '08123456789' . $i,
            ]);
        }
    }
}
