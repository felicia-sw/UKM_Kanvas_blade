<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactUs;
use App\Models\User;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        ContactUs::create([
            'full_name' => $user->name,
            'email' => $user->email,
            'tele_number' => '081234567890',
            'subject' => 'Question about event',
            'message' => 'I have a question about the upcoming event.',
            'user_id' => $user->id,
        ]);

        ContactUs::create([
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'tele_number' => '089876543210',
            'subject' => 'General Inquiry',
            'message' => 'I have a general inquiry.',
            'user_id' => null,
        ]);
    }
}
