<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reportRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'topic_id' => 'required|exists:topics,id'
        ];//این کار نمیکنه بعدا میتونم تستش کنم فعلا بیخیالش
    }
}
