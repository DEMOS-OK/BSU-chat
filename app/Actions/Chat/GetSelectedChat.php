<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Collection;

final class GetSelectedChat
{
    /**
     * Returns selected user chat
     *
     * @param Collection $chats
     * @param int|null $chatId
     * @return Chat|null
     */
    public function __invoke(Collection $chats, int|null $chatId): ?Chat
    {
        /** @var Chat $selectedChat */
        $selectedChat = $chats->where('id', $chatId)->first() ?? $chats->first();
        if (!$selectedChat) {
            return null;
        }

        $selectedChat->load('messages');

        return $selectedChat;
    }
}
