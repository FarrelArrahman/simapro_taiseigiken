<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'role' => 'required|in:Admin,Project Head,Worker,Manager',
            'profile_picture' => 'nullable|file',
        ];
    }
}
