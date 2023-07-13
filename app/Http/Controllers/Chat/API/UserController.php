<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat\API;

use App\Actions\Chat\SearchUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SearchRequest;
use Illuminate\Http\JsonResponse;

final class UserController extends Controller
{
    /**
     * Searches the users and returns response
     *
     * @param SearchRequest $request
     * @param SearchUsers $searchUsers
     * @return JsonResponse
     */
    public function search(SearchRequest $request, SearchUsers $searchUsers): JsonResponse
    {
        return response()->json([
            'users' => $searchUsers($request->data())
        ]);
    }
}
