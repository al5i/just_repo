<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email:exist:users|max:255|regex:/^[a-zA-Z0-9._%+-]+@mail\.ru$/',
//            'password' =>  'required|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле заголовка обязательно для заполнения.',
            'name.string' => 'Заголовок должен быть строкой.',
            'name.max' => 'Заголовок не должен превышать :max символов.',
            'email.required' => 'Содержимое обязательно для заполнения.',
            'email.regex' => 'Неверный домен электронной почты. Разрешены только @mail.ru',
            'email.unique' => 'Такой пользователь уже существует.',
            'password.required' => 'Поле обязательно для заполнения.',
            'password.max' => 'Изображение не должно превышать :max килобайт.',
        ];
    }
}
