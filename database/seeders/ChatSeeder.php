<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create chats
        Chat::factory()->count(5)->create();

        // Add messages and users to the chats
        $chats = Chat::all();
        /** @var Chat $chat */
        foreach ($chats as $chat) {
            $users = User::inRandomOrder()->limit(10)->get();
            foreach ($users as $user) {
                Message::factory()->chat($chat->id)->user($user->id)
                    ->count(3)->create();
                $chat->users()->attach($user->id);
            }
        }
    }
}
