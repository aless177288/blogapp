<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'        => 'required|string|max:255',
            'body'         => 'nullable|string',
            'excerpt'      => 'nullable|string',
            'published_at' => 'nullable|date',
            'category_id'  => 'nullable|exists:categories,id',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ];
    }
}
