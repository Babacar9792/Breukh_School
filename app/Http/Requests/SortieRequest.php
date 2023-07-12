<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SortieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            "ids" => "required|array", 
            "ids.*" => "integer" 
        ];
    }
    public function messages()
    {
        return [
            "ids.required" => "Champ est obligatoire",
            "ids.array"=> "Les données passées doit etre dans un tableau",
            "ids.*.integer" => "Les données dans le tableau doit etre de type entier" 
        ];
    }

    protected function errorValidation(Validator $validator)
    {
            throw new HttpResponseException(response()->json($validator->errors())); 
    }
}
