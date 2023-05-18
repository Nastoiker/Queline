<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'video' => 'required|mimes:mp4|min:1',
            'title' => 'required|string|min:1|max:50',
            'category_id' => 'required|exists:categories,id',
            'preview' => 'required|image:jpg,png,webp',
            'description' => 'required|string|min:2',
            'tags' => 'JSON'
        ];
    }
}
