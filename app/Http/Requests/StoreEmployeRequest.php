<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "nom" => 'required|string|max:55',
            "prenom" => 'required|string|max:55',
            "fonction" => 'required|string|max:55',
            "sexe" => [
                'required',
                'string',
                Rule::in(['Femme', 'Homme'])
            ],
            "date_naissance" => ['required','date','after:1960-01-01', 'before:2005-01-01'],
            "date_recrutement" =>['required','date','after:2016-01-01', 'before:2023-04-08'],
            "contract" => [
                'required',
                'string',
                Rule::in(['CDI', 'CDD'])
            ],
            "temp_occuper" => [
                'required',
                'string',
                Rule::in(['Temps plein', 'Temps partiel'])
            ],

            "handicape" => 'boolean',            
        ];
    }
}
