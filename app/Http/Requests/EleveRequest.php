<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleveRequest extends FormRequest
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
            'date_naissance' => 'sometimes|date|before:today-5years',
        ];
    }

    public function message()
    {
        return [
            "date_naissance.date" => "date invalide"
        ];
    }
}
