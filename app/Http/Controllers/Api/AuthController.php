<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email);

        try {
            if (empty($user->count())) {
                throw new Exception();
            }
            $user = $user->first();

            if (!Hash::check($request->input('password'), $user->password)) {
                throw new Exception();
            }

            $token = $user->createToken('user_token')->plainTextToken;
            return response()->json([
                'user_token' => $token
            ], 200, [
                'Content-type' => 'application/json'
            ]);

        } catch (Exception) {
            return response()->json([
                'error' => [
                    'message' => 'Неправильный логин или пароль'
                ]
            ], 422, [
                'Content-type' => 'application/json'
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $profile = Image::make($file->get())->encode('webp');
            $profile_name = time() . '.webp';
            $profile_path = '/app/public/profile_photo/' . $profile_name;
            $profile->save(storage_path($profile_path), null, 'webp');
        }
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $banner = Image::make($file->get())->encode('webp');
            $banner_name = time() . '.webp';
            $banner_path = '/app/public/profile_banner/' . $banner_name;
            $banner->save(storage_path($banner_path), null, 'webp');
        }

        $user = User::create([
            'nickname' => $request->input('nickname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'photo' => $profile_path ?? null,
            'banner' => $banner_path ?? null
        ]);
        $token = $user->createToken('user_token')->plainTextToken;
        return response()->json([
            'user_token' => $token
        ], 200, [
            'Content-type' => 'application/json'
        ]);
    }

    public function logout(Request $request)
    {
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
        $user = User::findOrFail($user_id);
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Вы вышли из аккаунта'
        ]);
    }

}
