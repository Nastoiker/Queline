<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\DefaultCategoryResource;
use App\Http\Resources\User\DefaultUserResource;
use App\Http\Resources\Video\DefaultVideoResource;
use App\Models\Category;
use App\Models\Tags;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $response['videos'] = DefaultVideoResource::collection(Video::search($q)->get());
        $response['categories'] = DefaultCategoryResource::collection(Category::search($q)->get());
        $response['users'] = DefaultUserResource::collection(User::search($q)->get());

        return $response;
    }
}
