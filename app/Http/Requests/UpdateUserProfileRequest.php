<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'name' => 'required',
            'oldPsw' => $this->whenFilled('oldPsw', fn() => 'required'),
            'newPsw' => $this->whenFilled('oldPsw', fn() => ['required', 'same:passwordConfirmation'])
        ];
    }
}