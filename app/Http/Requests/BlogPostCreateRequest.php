<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'title' => 'required|min:5|max:200|unique:blog_posts',
            'slug' => 'max:200|unique:blog_posts',
            'content_raw' => 'required|string|min:5|max:10000',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'excerpt' => 'max:500|nullable',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Введіть заголовок статті',
            'title.min' => 'Заголовок статті має бути не менше :min символів.',
            'title.max' => 'Заголовок статті має бути не більше :max символів.',
            'title.unique' => 'Стаття з таким заголовком вже існує.',
            'slug.max' => 'Максимальна довжина псевдоніма [:max] символів.',
            'slug.unique' => 'Псевдонім вже використовується.',
            'content_raw.required' => 'Поле "Текст статті" є обов\'язковим.',
            'content_raw.min' => 'Мінімальна довжина статті [:min] символів',
            'content_raw.max' => 'Максимальна довжина статті [:max] символів.',
            'category_id.required' => 'Оберіть категорію.',
            'category_id.exists' => 'Обрана категорія не існує.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Заголовок статті',
            'slug' => 'Псевдонім',
            'content_raw' => 'Текст статті',
            'category_id' => 'Категорія',
            'excerpt' => 'Короткий текст',
            'is_published' => 'Опубліковано',
        ];
    }
}
