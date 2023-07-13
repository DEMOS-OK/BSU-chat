<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\DTO\ManageChatDTO;
use App\Actions\Chat\Exceptions\ChatSavingException;
use App\Models\Chat;

final class StoreChat
{
    /**
     * Creates a new chat instance
     *
     * @throws ChatSavingException
     */
    public function __invoke(ManageChatDTO $data): bool
    {
        $chat = new Chat();

        $chat->title = $data->getTitle();

        if (!$chat->save()) {
            throw new ChatSavingException();
        }

        $chat->users()->attach($data->getUsersIds());

        return true;
    }
}
