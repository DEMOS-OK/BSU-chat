<?php

namespace App\Http\Middleware;

use App\Models\Chat;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserInChat
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $chat = Chat::findOrFail((int)$request->input('chat_id'));
        if (!Gate::allows('load-more-messages', $chat)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
