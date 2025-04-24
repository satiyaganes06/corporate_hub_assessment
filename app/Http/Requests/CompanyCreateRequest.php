<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
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
        
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:companies,email',
            'logo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_link' =>'required|string|max:255|unique:companies,website_link'
        ];
    }

    /**
     * Function: failedValidation
     * 
     * @param Validator $validator
     * @author satiyaG <satiyaganes.sg@gmail.com>
    */
    protected function failedValidation(Validator $validator)
    {
        return redirect()->back()->withErrors($validator)->withInput();
    }
}
