<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'project_code' => 'required|string',
            'project_name' => 'required|string',
            'time_of_contract' => 'required|numeric',
            'drm_value' => 'required',
            'project_head_id' => 'required|exists:users,id',
            'vendor_id' => 'required|exists:vendors,id',
            'begin_date' => 'required|date',
        ];
    }
}
