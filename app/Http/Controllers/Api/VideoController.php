<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoRequest;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        dd($request->file('video')->getExtension());
    }
}
