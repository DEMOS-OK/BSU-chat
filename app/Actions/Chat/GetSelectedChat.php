<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Collection;

final class GetSelectedChat
{
    /**
     * @param int $countOnPage
     */
    public function __construct(private readonly int $countOnPage)
    {
    }

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

        return $this->loadLastMessages($selectedChat);
    }

    /**
     * Load last related messages
     *
     * @param Chat $chat
     * @return Chat
     */
    private function loadLastMessages(Chat $chat): Chat
    {
        $countOnPage = $this->countOnPage;
        return $chat->load([
            'messages' => static function ($q) use ($countOnPage) {
                $q->limit($countOnPage)->orderBy('id', 'desc');
            }
        ]);
    }
}
