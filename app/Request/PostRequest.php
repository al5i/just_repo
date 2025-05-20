<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'content' => 'required|unique:posts|max:255',
            'image' =>  'required|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле заголовка обязательно для заполнения.',
            'title.string' => 'Заголовок должен быть строкой.',
            'title.max' => 'Заголовок не должен превышать :max символов.',
            'content.required' => 'Содержимое обязательно для заполнения.',
            'image.image' => 'Файл должен быть изображением.',
            'image.max' => 'Изображение не должно превышать :max килобайт.',
        ];
    }
}
