<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'national_identity_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|unique:users',
            'role' => 'required|in:Admin,Project Head,Worker,Manager',
            'profile_picture' => 'nullable|file',
        ];
    }
}
