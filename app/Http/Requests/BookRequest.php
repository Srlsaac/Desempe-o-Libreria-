<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $book = $this->route('book');

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:255', Rule::unique('books', 'isbn')->ignore($book)],
            'description' => ['nullable', 'string'],
            'year' => ['nullable', 'integer', 'min:1000', 'max:'.now()->year],
            'copies_total' => ['required', 'integer', 'min:1'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Selecciona una categoría.',
            'author_id.required' => 'Selecciona un autor.',
            'title.required' => 'El título es obligatorio.',
            'isbn.unique' => 'Ya existe un libro con ese ISBN.',
            'copies_total.required' => 'Indica el número de copias.',
            'copies_total.min' => 'Debe haber al menos 1 copia.',
        ];
    }
}
