<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "email" => "required|string|max:255",
            "number" => "required|max:255",
            "role" => "required",
            "password" => "sometimes|nullable|max:255",
            "profile" => "sometimes|nullable|mimes:jpg,png,jpeg",
            "date" => "required|date",
        ];
    }
}
