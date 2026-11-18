<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerguntaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'evento_id' => ['required', 'exists:eventos,id'],
            'texto_pergunta' => ['required', 'string', 'max:1000'],
            'autor' => ['nullable', 'string', 'max:255'],
        ];
    }
}
