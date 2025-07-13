<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CitiesRequest extends FormRequest
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
            'city_name' => 'required|string',
            'city_uf' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'city_name.required' => 'O nome da cidade é obrigatório.',
            'city_name.string' => 'O nome da cidade deve ser uma string válida.',

            'city_uf.required' => 'A UF da cidade é obrigatória.',
            'city_uf.string' => 'A UF da cidade deve ser uma string válida.'
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
