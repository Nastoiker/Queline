<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category\DefaultCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        return DefaultCategoryResource::collection(Category::all());
    }

    public function store(CategoryStoreRequest $request)
    {
        $photo = $request->file('photo');
        $photo = Image::make($photo->get())->encode('webp');
        $photo_name = time() . '.webp';
        $photo_path = '/app/public/categories/' . $photo_name;
        $photo->save(storage_path($photo_path), null, 'webp');

        Category::create([
            'title' => $request->input('title'),
            'photo' => $photo_path
        ]);

        return response()->json([
            'message' => 'Категория добавлена'
        ]);
    }

    public function update($id, CategoryUpdateRequest $request)
    {
        $category = Category::findOrFail($id);

        if ($request->has('title')) {
            $updateData['title'] = $request->input('title');
        }

        if ($request->hasFile('photo')) {
            $old_photo = substr($category->photo, 5);
            Storage::disk('local')->delete($old_photo);
            $photo = $request->file('photo');
            $photo = Image::make($photo->get())->encode('webp');
            $photo_name = time() . '.webp';
            $photo_path = '/app/public/categories/' . $photo_name;
            $photo->save(storage_path($photo_path), null, 'webp');
            $updateData['preview'] = $photo_path;
        }

        $category->update($updateData);

        return response()->json([
            'message' => 'Категория изменена'
        ]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $old_photo = substr($category->photo, 5);
        Storage::disk('local')->delete($old_photo);
        $category->delete();
        return response(null, 204);
    }
}
