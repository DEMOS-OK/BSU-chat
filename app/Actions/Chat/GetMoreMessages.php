<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\DTO\LoadMoreMessagesDTO;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

final class GetMoreMessages
{
    public function __construct(private readonly int $countOnPage)
    {
    }

    /**
     * Returns next messages slice
     *
     * @param LoadMoreMessagesDTO $data
     * @return Collection
     */
    public function __invoke(LoadMoreMessagesDTO $data): Collection
    {
        $query = Message::query()->where('chat_id', $data->getChatId());

        $toSkip = $data->getStep() * $this->countOnPage;

        return $query->skip($toSkip)->take($this->countOnPage)
            ->orderBy('id', 'desc')->get();
    }
}
