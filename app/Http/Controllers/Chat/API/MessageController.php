<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat\API;

use App\Actions\Chat\GetMoreMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\LoadMoreRequest;
use Illuminate\Http\JsonResponse;

final class MessageController extends Controller
{
    /**
     * Returns response with more messages info
     *
     * @param LoadMoreRequest $request
     * @param GetMoreMessages $getMoreMessages
     * @return JsonResponse
     */
    public function loadMore(LoadMoreRequest $request, GetMoreMessages $getMoreMessages): JsonResponse
    {
        return response()->json([
            'messages' => $getMoreMessages($request->data()),
        ]);
    }
}
