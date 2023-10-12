<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company.country' => 'string|required',
            'company.name' => 'string|required',
            'company.activities' => 'string|required',
            'company.package' => 'string|required',

            'partners.*.first_name' => 'string|required',
            'partners.*.last_name' => 'string|required',
            'partners.*.nationality' => 'string|required',
            'partners.*.country' => 'string|required',
            'partners.*.city' => 'string|required',
            'partners.*.address' => 'string|required',
            'partners.*.whatsapp_number' => 'string|required',
            'partners.*.email' => 'string|required',
            'partners.*.dob' => 'string|required',
            'partners.*.share_holds' => 'string|required',
            'partners.*.passport' => 'required',
        ];
    }
}
