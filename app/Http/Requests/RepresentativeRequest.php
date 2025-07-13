<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RepresentativeRequest extends FormRequest
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
            'representative_name' => 'required|string',
            'representative_email' => 'required|string',
            'representative_phone' => 'required|string',

            'city_id' => 'required|integer|exists:cities,city_id',
        ];
    }

    public function messages(): array
    {
        return [
            'representative_name.required' => 'O nome do representante é obrigatório.',
            'representative_name.string' => 'O nome do representante deve ser um texto válido.',

            'representative_email.required' => 'O e-mail do representante é obrigatório.',
            'representative_email.string' => 'O e-mail do representante deve ser um texto válido.',

            'representative_phone.required' => 'O telefone do representante é obrigatório.',
            'representative_phone.string' => 'O telefone do representante deve ser um texto válido.',

            'city_id.required' => 'A cidade é obrigatória.',
            'city_id.integer' => 'A cidade deve ser um valor válido.',
            'city_id.exists' => 'A cidade selecionada não existe em nosso cadastro.',
        ];
    }

    protected function failedValidation(Validator $validator)
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
