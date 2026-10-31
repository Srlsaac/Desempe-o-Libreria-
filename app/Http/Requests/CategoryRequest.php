<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['slug' => Str::slug((string) $this->name)]);
    }

    public function rules(): array
    {
        $category = $this->route('category');

        return [
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('categories', 'name')->ignore($category),
            ],
            'slug' => [
                'required',
                Rule::unique('categories', 'slug')->ignore($category),
            ],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'slug.unique' => 'Ya existe una categoría con un nombre equivalente.',
        ];
    }
}
