<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\DefaultUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me($nickname)
    {
        return new DefaultUserResource(User::where('nickname', $nickname)->first());
    }
}
