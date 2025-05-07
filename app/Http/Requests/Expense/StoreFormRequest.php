<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreFormRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'DESPESA' => 'required|string|max:255',
            'DESCRICAO' => 'nullable|string',
            'VALOR' => 'required|numeric|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'TIPO' => 'required|in:ENTRADA,SAIDA',
            'DATA' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'DESPESA.required' => 'O campo "Despesa" é obrigatório.',
            'DESPESA.string' => 'O campo "Despesa" deve ser uma string.',
            'DESPESA.max' => 'O campo "Despesa" não pode ter mais de 255 caracteres.',

            'DESCRICAO.string' => 'O campo "Descrição" deve ser uma string.',

            'VALOR.required' => 'O campo "Valor" é obrigatório.',
            'VALOR.numeric' => 'O campo "Valor" deve ser numérico.',
            'VALOR.regex' => 'O campo "Valor" deve ter até 13 dígitos inteiros e até 2 casas decimais.',

            'TIPO.required' => 'O campo "Tipo" é obrigatório.',
            'TIPO.in' => 'O campo "Tipo" deve ser "ENTRADA" ou "SAIDA".',

            'DATA.required' => 'O campo "Data" é obrigatório.',
            'DATA.date' => 'O campo "Data" deve ser uma data válida.',
        ];
    }
}
