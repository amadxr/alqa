<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateArtwork extends FormRequest
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
            'data.artwork.id' => 'required|numeric',
            'data.artwork.name' => 'required|min:3',
            'data.artwork.origin' => 'required|min:3',
            'data.artwork.description' => 'required|min:3',
            'data.artwork.width' => 'required|numeric',
            'data.artwork.length' => 'required|numeric',
            'data.artwork.depth' => 'nullable|numeric',
            'data.artwork.price' => 'required|numeric',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'data' => json_decode($this->data, true),
        ]);
    }
}
