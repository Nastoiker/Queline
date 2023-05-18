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
        return new DefaultUserResource(User::findOrFail(PersonalAccessToken::findToken($request->bearerToken())));
    }
}
