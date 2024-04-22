<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDestinyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'min:3'],
            'price' => ['numeric'],
            'photo_1' => ['file', 'mimes:png,jpg,jpeg'],
            'photo_2' => ['file', 'mimes:png,jpg,jpeg'],
            'meta' => ['string', 'min:3', 'max:160'],
            'description' => ['string']
        ];
    }
}
