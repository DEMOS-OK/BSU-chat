<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\DTO\GetMessagesForChatDTO;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

final class GetMessagesForChat
{
    public function __construct(private readonly int $countOnPage)
    {
    }

    /**
     * Returns next messages slice
     *
     * @param GetMessagesForChatDTO $data
     * @return Collection
     */
    public function __invoke(GetMessagesForChatDTO $data): Collection
    {
        $query = Message::query()->where('chat_id', $data->getChatId());

        $toSkip = $data->getStep() * $this->countOnPage;
        return $query->orderBy('id', 'desc')
            ->noRelation()
            ->skip($toSkip)->take($this->countOnPage)->get();
    }
}
