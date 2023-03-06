<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'package_id' => 'required|numeric|exists:packages,id',
            'subscription_type' => 'required|string',
            'delivery_time'=>'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}