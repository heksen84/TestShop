<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'integer|min:0',
            'name' => 'string',
            'description' => 'string',
            'image' => 'file|mimes:jpeg,png,jpg',
            'price' => 'integer|min:0',
            'available' => 'boolean|required'
        ];
    }

    /**
     * Prepare inputs for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'available' => $this->available === 'true' ? 1 : 0
        ]);
    }
}
