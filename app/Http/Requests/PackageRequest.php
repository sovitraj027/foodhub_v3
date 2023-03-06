<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            // 'image' => 'nullable|image',
            'type' => 'required',
            'status' => 'required',
            'price' => 'nullable',
            'menu_items.*' => 'integer',
            'menu_items' => 'required|array',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}