<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\DTO\MessageStoreDTO;
use App\Actions\Chat\Exceptions\MessageSavingException;
use App\Models\Message;

final class StoreMessage
{
    /**
     * Store message data in the storage
     *
     * @param MessageStoreDTO $data
     * @return bool
     * @throws MessageSavingException
     */
    public function __invoke(MessageStoreDTO $data): bool
    {
        // Create new message instance
        $message = new Message();

        // Fill message data
        $message->chat_id = $data->getChatId();
        $message->user_id = $data->getUserId();
        $message->text = $data->getText();

        if (!$message->save()) {
            $chatId = $data->getChatId();
            $text = $data->getText();
            throw new MessageSavingException(
                "Error when saving message for chat $chatId with text - $text"
            );
        }

        return true;
    }
}
