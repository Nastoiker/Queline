<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\DefaultUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        return new DefaultUserResource(User::findOrFail($token->tokenable_id));
    }
}
