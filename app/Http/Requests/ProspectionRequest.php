<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProspectionRequest extends FormRequest
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
            'agent_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'address' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required',
            'product' => [
                'required',
                Rule::in(['table', 'chaise', 'ordinateur', 'ecran'])
            ],
            'observation' => 'string|nullable',
            'is_sold' => 'boolean'
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'is_sold' => $this->has('is_sold')
        ]);
    }
}
