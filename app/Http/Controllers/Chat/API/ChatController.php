<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat\API;

use App\Actions\Chat\Exceptions\ChatSavingException;
use App\Actions\Chat\StoreChat;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreRequest;
use Illuminate\Http\JsonResponse;

final class ChatController extends Controller
{
    /**
     * Create a new chat and returns response
     *
     * @param StoreRequest $request
     * @param StoreChat $storeChat
     * @return JsonResponse
     * @throws ChatSavingException
     */
    public function store(StoreRequest $request, StoreChat $storeChat): JsonResponse
    {
        return response()->json([
            'success' => $storeChat($request->data())
        ]);
    }
}
