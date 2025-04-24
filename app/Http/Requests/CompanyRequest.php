<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * @author satiyaG <satiyaganes.sg@gmail.com>
     */
    public function rules(): array
    {
        $companyId = $this->route('company'); // Get company ID from route if it exists
        
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('companies')->ignore($companyId)
            ],
            'logo' => $this->isMethod('put') ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_link' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies')->ignore($companyId)
            ]
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email address is already used by another company.',
            'website_link.unique' => 'This website link is already used by another company.'
        ];
    }
}