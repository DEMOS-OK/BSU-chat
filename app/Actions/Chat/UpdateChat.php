<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\DTO\ManageChatDTO;
use App\Actions\Chat\Exceptions\ChatNotFoundException;
use App\Actions\Chat\Exceptions\ChatSavingException;
use App\Models\Chat;

final class UpdateChat
{
    /**
     * Updates existing chat data
     *
     * @param ManageChatDTO $data
     * @return bool
     * @throws ChatSavingException|ChatNotFoundException
     */
    public function __invoke(ManageChatDTO $data): bool
    {
        $chat = $this->findChat($data->getChatId());

        $chat->title = $data->getTitle();
        if (!$chat->save()) {
            throw new ChatSavingException();
        }


        $chat->users()->attach($data->getUsersIds());

        return true;
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
