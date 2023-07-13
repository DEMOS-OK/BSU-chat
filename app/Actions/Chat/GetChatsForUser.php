<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Collection;

final class GetChatsForUser
{
    /**
     * Returns all related chats for the user
     *
     * @param int $userId
     * @return Collection<Chat>
     */
    public function __invoke(int $userId): Collection
    {
        return Chat::whereHas('users', static function ($q) use ($userId) {
            $q->where('users.id', $userId);
        })->orderBy('id', 'desc')->get();
    }
}
