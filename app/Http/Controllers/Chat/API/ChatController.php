<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat\API;

use App\Actions\Chat\Exceptions\ChatNotFoundException;
use App\Actions\Chat\Exceptions\ChatSavingException;
use App\Actions\Chat\Exceptions\UserNotFoundException;
use App\Actions\Chat\RemoveUserFromChat;
use App\Actions\Chat\StoreChat;
use App\Actions\Chat\UpdateChat;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ManageRequest;
use App\Http\Requests\Chat\RemoveUserRequest;
use Illuminate\Http\JsonResponse;

final class ChatController extends Controller
{
    /**
     * Create a new chat and returns response
     *
     * @param ManageRequest $request
     * @param StoreChat $storeChat
     * @return JsonResponse
     * @throws ChatSavingException
     */
    public function store(ManageRequest $request, StoreChat $storeChat): JsonResponse
    {
        return response()->json([
            'success' => $storeChat($request->data())
        ]);
    }

    /**
     * Update existing chat data and returns response
     *
     * @param ManageRequest $request
     * @param UpdateChat $updateChat
     * @return JsonResponse
     * @throws ChatNotFoundException
     * @throws ChatSavingException
     */
    public function update(ManageRequest $request, UpdateChat $updateChat): JsonResponse
    {
        return response()->json([
            'success' => $updateChat($request->data())
        ]);
    }

    /**
     * Removes the userfrom the chat and returns json response
     *
     * @param RemoveUserRequest $request
     * @param RemoveUserFromChat $removeUserFromChat
     * @return JsonResponse
     * @throws ChatNotFoundException|UserNotFoundException
     */
    public function removeUser(RemoveUserRequest $request, RemoveUserFromChat $removeUserFromChat): JsonResponse
    {
        $userId = (int)$request->input('user_id');
        $chatId = (int)$request->input('chat_id');

        return response()->json([
            'success' => $removeUserFromChat($userId, $chatId),
        ]);
    }
}
