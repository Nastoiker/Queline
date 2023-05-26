<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserBannerRequest;
use App\Http\Requests\User\UserNicknameRequest;
use App\Http\Requests\User\UserPhotoRequest;
use App\Http\Resources\User\DefaultUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        return new DefaultUserResource(User::findOrFail($token->tokenable_id));
    }

    public function updatePhoto(UserPhotoRequest $request) {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = User::findOrFail($token->tokenable_id);
        $old_photo = substr($user->photo, 5);
        Storage::disk('local')->delete($old_photo);
        $photo = $request->file('photo');
        $photo = Image::make($photo->get())->encode('webp');
        $photo_name = time() . '.webp';
        $photo_path = '/app/public/profile_photo/' . $photo_name;
        $photo->save(storage_path($photo_path), null, 'webp');

        $user->update([
            'photo' => $photo_path
        ]);

        return response()->json([
            'message' => 'Фото профиля изменено'
        ]);
    }

    public function updateBanner(UserBannerRequest $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = User::findOrFail($token->tokenable_id);
        $old_banner = substr($user->banner, 5);
        Storage::disk('local')->delete($old_banner);
        $banner = $request->file('banner');
        $banner = Image::make($banner->get())->encode('webp');
        $banner_name = time() . '.webp';
        $banner_path = '/app/public/profile_banner/' . $banner_name;
        $banner->save(storage_path($banner_path), null, 'webp');

        $user->update([
            'banner' => $banner_path
        ]);

        return response()->json([
            'message' => 'Баннер профиля изменен'
        ]);
    }

    public function updateNickname(UserNicknameRequest $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = User::findOrFail($token->tokenable_id);
        $user->update([
            'nickname' => $request->input('nickname')
        ]);

        return response()->json([
            'message' => 'Ник изменен'
        ]);
    }
}
