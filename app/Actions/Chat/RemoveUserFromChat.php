<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\Exceptions\ChatNotFoundException;
use App\Actions\Chat\Exceptions\UserNotFoundException;
use App\Models\Chat;
use App\Models\User;

final class RemoveUserFromChat
{
    /**
     * Removes the user from the chat
     *
     * @param int $userId
     * @param int $chatId
     * @return bool
     * @throws UserNotFoundException
     * @throws ChatNotFoundException
     */
    public function __invoke(int $userId, int $chatId): bool
    {
        $user = $this->findUser($userId);
        $chat = $this->findChat($chatId);

        $chat->users()->detach($user->id);

        return true;
    }

    /**
     * Returns chat by id
     *
     * @throws UserNotFoundException
     */
    private function findUser(int $id): User
    {
        $chat = User::find($id);
        if (!$chat) {
            throw new UserNotFoundException();
        }

        return $chat;
    }

    /**
     * Returns chat by id
     *
     * @throws ChatNotFoundException
     */
    private function findChat(int $id): Chat
    {
        $chat = Chat::find($id);
        if (!$chat) {
            throw new ChatNotFoundException();
        }

        return $chat;
    }
}
