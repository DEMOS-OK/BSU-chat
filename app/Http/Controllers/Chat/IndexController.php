<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Actions\Chat\DTO\GetMessagesForChatDTO;
use App\Actions\Chat\GetChatsForUser;
use App\Actions\Chat\GetMessagesForChat;
use App\Actions\Chat\GetSelectedChat;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{
    /**
     * Return view of the index page of the chat application
     *
     * @param Request $request
     * @param GetChatsForUser $getChatsForUser
     * @param GetSelectedChat $getSelectedChat
     * @param GetMessagesForChat $getMessagesForChat
     * @return Response
     */
    public function index(
        Request $request,
        GetChatsForUser $getChatsForUser,
        GetSelectedChat $getSelectedChat,
        GetMessagesForChat $getMessagesForChat,
    ): Response {
        // Get all chats and selected chat
        $chats = $getChatsForUser(Auth::user()->id);
        $selectedChat = $getSelectedChat($chats, (int)$request->get('chat_id'));

        // Get messages if selected chat exists
        $getMessagesDTO = new GetMessagesForChatDTO($selectedChat?->id);
        $messages = $getMessagesForChat($getMessagesDTO);

        return Inertia::render('Dashboard', [
            'chats' => $chats,
            'selectedChat' => $selectedChat,
            'messages' => $messages,
            'user' => Auth::user(),
        ]);
    }
}
