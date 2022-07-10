<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'title_alt' => 'required',
            'genre' => 'required',
            'author' => 'required',
            'studio' => 'required',
            'category_video' => 'required',
            'description' => 'required',
            'tag' => 'required',
            'tahunFilm' => 'required',
            'rating' => 'required',
            'thumbnail' => '',
            'video_id' => '',
            'channel_id' => 'required'
        ];
    }
}
