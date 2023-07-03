<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Actions\Chat\GetChatsForUser;
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
     * @return Response
     */
    public function index(
        Request $request,
        GetChatsForUser $getChatsForUser,
        GetSelectedChat $getSelectedChat
    ): Response {
        $chats = $getChatsForUser(Auth::user()->id);

        return Inertia::render('Dashboard', [
            'chats' => $chats,
            'selectedChat' => $getSelectedChat($chats, (int)$request->get('chat_id')),
            'user' => Auth::user(),
        ]);
    }
}
