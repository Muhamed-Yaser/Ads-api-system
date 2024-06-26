<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class MessageSendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator){
        if ($this->is('api/*')){
            // $errorReesponse = ApiResponse::error(422 , 'Validation Error' , $validator->errors());
            $errorReesponse = ApiResponse::error(422 , 'Validation Errors' , $validator->messages()->all());
            throw new ValidationException($validator , $errorReesponse);
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ];
    }


    public function attributes()
    {
        return [
        'name' => __('Name'),
        'email' => __('E-mail'),
        'phone' => __('Phone number'),
        'message' => __('Message')
        ];
    }
}