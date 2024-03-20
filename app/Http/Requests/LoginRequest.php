<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\FlareClient\Api;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if($this->is('api/*')){
            $errorResponse = ApiResponse::error(422 , 'Login validation error' , $validator->errors());
            throw new ValidationException($validator, $errorResponse);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ];
    }


    public function attributes()
    {
        return [
        'email' => __('الميل'),
        'password' => __('الباس وورد')
        ];
    }
}