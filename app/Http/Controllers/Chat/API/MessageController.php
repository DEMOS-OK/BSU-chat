<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat\API;

use App\Actions\Chat\DTO\GetMessagesForChatDTO;
use App\Actions\Chat\Exceptions\MessageSavingException;
use App\Actions\Chat\GetMessagesForChat;
use App\Actions\Chat\StoreMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\LoadMoreRequest;
use App\Http\Requests\Message\StoreRequest;
use Illuminate\Http\JsonResponse;

final class MessageController extends Controller
{
    /**
     * Returns response with more messages info
     *
     * @param LoadMoreRequest $request
     * @param GetMessagesForChat $getMessagesForChat
     * @return JsonResponse
     */
    public function loadMore(LoadMoreRequest $request, GetMessagesForChat $getMessagesForChat): JsonResponse
    {
        return response()->json([
            'messages' => $getMessagesForChat($request->data()),
        ]);
    }

    /**
     * Store message in database.
     * Returns JSON response
     *
     * @param StoreRequest $request
     * @param StoreMessage $storeMessage
     * @param GetMessagesForChat $getMessagesForChat
     * @return JsonResponse|null
     * @throws MessageSavingException
     */
    public function store(
        StoreRequest $request,
        StoreMessage $storeMessage,
        GetMessagesForChat $getMessagesForChat
    ): ?JsonResponse {
        $data = $request->data();

        return response()->json([
            'success' => $storeMessage($data),
            'messages' => $getMessagesForChat(new GetMessagesForChatDTO($data->getChatId())),
        ]);
    }
}
