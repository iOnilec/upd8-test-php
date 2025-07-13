<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ClientsRequest extends FormRequest
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
            'client_name' => 'required|string',
            'client_address' => 'required|string',
            // 'client_state' => 'required|string',
            // 'client_city' => 'required|string',
            'client_cpf' => [
                'required',
                'string',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$|^\d{11}$/'
            ],
            'client_sex' => 'required|string',

            # FK
            'city_id' => 'required|integer|exists:cities,city_id',
        ];
    }

    public function messages(): array
    {
        return [
            'client_name.required' => 'O nome do cliente é obrigatório.',
            'client_name.string' => 'O nome do cliente deve ser um texto.',

            'client_address.required' => 'O endereço do cliente é obrigatório.',
            'client_address.string' => 'O endereço do cliente deve ser um texto.',

            // 'client_state.required' => 'O estado do cliente é obrigatório.',
            // 'client_state.string' => 'O estado do cliente deve ser um texto.',

            // 'client_city.required' => 'A cidade do cliente é obrigatória.',
            // 'client_city.string' => 'A cidade do cliente deve ser um texto.',

            'client_cpf.required' => 'O CPF do cliente é obrigatório.',
            'client_cpf.string' => 'O CPF do cliente deve ser um texto.',
            'client_cpf.regex' => 'O CPF do cliente deve estar no formato válido (123.456.789-09 ou 12345678909).',

            'client_sex.required' => 'O sexo do cliente é obrigatório.',
            'client_sex.string' => 'O sexo do cliente deve ser um texto.',

            'city_id.required' => 'A cidade vinculada ao cliente é obrigatória.',
            'city_id.integer' => 'O campo cidade vinculada deve ser um número inteiro.',
            'city_id.exists' => 'A cidade selecionada não existe no cadastro.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            response()->json([
                'status' => 424,
                'message' => 'Erro na validação dos dados.',
                'errors' => $validator->errors(),
            ])
        );
    }
}
