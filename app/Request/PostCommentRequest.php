<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
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
            'message' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Поле заголовка обязательно для заполнения.',
            'message.string' => 'Заголовок должен быть строкой.',
            'message.max' => 'Заголовок не должен превышать :max символов.',
        ];
    }
}
