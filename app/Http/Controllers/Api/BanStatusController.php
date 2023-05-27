<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BanStatus;
use Illuminate\Http\Request;

class BanStatusController extends Controller
{
    public function all()
    {
        return BanStatus::all();
    }
}
