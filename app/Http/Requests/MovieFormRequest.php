<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'trailer_url' => 'nullable|string|max:255',
            'genre_code' => 'required|string|max:20',
            'synopsis' => 'required|string',
            'poster_filename' => 'nullable|string|max:255',
        ];
    }
}
