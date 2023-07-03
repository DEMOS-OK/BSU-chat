<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Model related with the factory
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->text,
            'user_id' => User::inRandomOrder()->first(),
            'chat_id' => Chat::inRandomOrder()->first(),
        ];
    }

    public function chat(int $chatId): self
    {
        return $this->state([
            'chat_id' => $chatId
        ]);
    }

    public function user(int $userId): self
    {
        return $this->state([
            'user_id' => $userId
        ]);
    }
}
