<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            "title" => "required|max:255|min:2",
            "resume" => "required|max:1000|min:10",
            "published_at" => "required|date",
            "cover" => "required|url",
            "price" => "required|numeric|min:0",
            "editor_id" => "required|exists:App\Models\Editor,id",
        ];
    }
}
