<?php

namespace App\Http\Requests;

use App\Rules\MobileRule;
use Illuminate\Foundation\Http\FormRequest;

class userLoginRequest extends FormRequest

{
    use \App\Http\Requests\GetValueAndFieldRegisterTrait;
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
        $rules = [
            'type' => 'required|in:email,mobile',
        ];

        if ($this->input('type') == 'email') {
            $rules['email'] = ['required','email' , 'exists:users,email'];
        }
        elseif ($this->input('type') == 'mobile') {
            $rules['mobile'] = ['required', new MobileRule() , 'exists:users,mobile'];
        }
        return $rules;
    }
}
