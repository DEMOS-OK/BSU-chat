<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Chat\DTO\SearchUsersDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class SearchUsers
{
    /**
     * Returns collection of the users by search query
     *
     * @param SearchUsersDTO $data
     * @return Collection<User>
     */
    public function __invoke(SearchUsersDTO $data): Collection
    {
        $name = $data->getName();
        $except = $data->getExcept();

        return User::where('name', 'like', "%$name%")
            ->whereNotIn('id', $except)
            ->emailVerified()
            ->get();
    }
}
