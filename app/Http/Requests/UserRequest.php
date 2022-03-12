<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
//        Log::debug($this->user->id);

        $rules = [
            'name' => 'required|min:3|max:255',
            'password' => 'required|min:3|max:255',

        ];

        if (!isset($this->user)) {
            $rules['email'] = 'required|min:10|max:255|unique:users,email|email';
        } else {
            $rules['email'] = [
                'required',
                'min:10',
                'max:255',
                'email',
                Rule::unique('users','email')->ignore($this->user->id),
            ];
        }

        return $rules;
    }
}
