<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DestroyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'CODDESPESA' => 'required|uuid|exists:DESPESAS,CODDESPESA',
        ];
    }

    public function messages(): array
    {
        return [
            'CODDESPESA.required' => 'O campo "Código da Despesa" é obrigatório.',
            'CODDESPESA.uuid' => 'O campo "Código da Despesa" deve ser um UUID válido.',
            'CODDESPESA.exists' => 'O "Código da Despesa" informado não existe no sistema.',
        ];
    }
}
