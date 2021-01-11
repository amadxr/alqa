<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class ArtworkRequest extends FormRequest
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
        $skuRule = Rule::unique('artworks', 'sku');

        if ($this->method() !== 'POST') {
            $skuRule->ignore($this->artwork->id);
        }

        return [
            'data.artwork.name' => ['required', 'min:3'],
            'data.artwork.origin' => ['required', 'min:3'],
            'data.artwork.description' => ['required', 'min:3'],
            'data.artwork.sku' => ['required', 'min:3', $skuRule],
            'data.artwork.width' => ['required', 'numeric'],
            'data.artwork.length' => ['required', 'numeric'],
            'data.artwork.depth' => ['nullable', 'numeric'],
            'data.artwork.price' => ['required', 'numeric'],
            'data.artwork.forSale' => ['required', 'boolean'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'data' => json_decode($this->data, true),
        ]);
    }
}
