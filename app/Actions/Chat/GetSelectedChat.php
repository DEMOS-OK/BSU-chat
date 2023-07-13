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
    public function __invoke(Collection $chats, int|null $chatId = null): ?Chat
    {
        /** @var Chat $selectedChat */
        $selectedChat = $chats->where('id', $chatId)->first() ?? $chats->first();
        $selectedChat?->load([
            'users' => static function ($query) {
                $query->emailVerified()->distinct('id');
            }
        ]);

        return $selectedChat ?? null;
    }
}
