<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->get();
        dd($user);
    }

    public function register(RegisterRequest $request)
    {
//        if ($request->hasFile('photo')) {
//            $file = $request->file('photo');
//            $filename = time() . '.' . $file->getClientOriginalExtension();
//
//            $path = $file->move(storage_path('\app\public\tmp'), $filename)->getPathname();
//
//            $image = Image::make(public_path($path))->encode('webp');
//
////            $tmp_path = $_FILES['photo']['tmp_name'];
////            $image = Image::make($tmp_path)->encode('webp');
////            $path = DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'profile_photo' . DIRECTORY_SEPARATOR;
////            $image->save(Storage::path($path) . $image);
//        }
    }

}
