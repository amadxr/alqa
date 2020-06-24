<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreWallpaper extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'image|file|max:5120',
            'data.wallpaper.active' => 'required|boolean'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'data' => json_decode($this->data, true),
        ]);
    }
}
