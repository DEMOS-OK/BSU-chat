<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    /**
     * Searches the users and returns response
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $users = User::where('name', 'like', "%" . $request->input('name_query') . "%")
            ->get();

        return response()->json([
            'users' => $users
        ]);
    }
}
