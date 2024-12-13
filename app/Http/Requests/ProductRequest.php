<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'old_price' => ['nullable', 'numeric'],
            'status' => ['boolean'],
            'additional_info' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'code' => ['nullable', 'string', 'max:255'],
            'images.*' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'color_id' => ['nullable'],
            'price_color' => ['nullable'],
            'stock' => ['required'],
        ];
    }


    public function messages(): array
    {
        return [
            'color_id.required' => 'The color is required.',
            'size_id.required' => 'The size is required.',
        ];
    }

}
