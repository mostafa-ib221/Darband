<?php

namespace App\Http\Requests\api\customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {return true;}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //'mobile' => 'required|regex:/(09)[0-9]{9}/|exists:customers,mobile',
            'mobile' => 'required',
            'password' => 'required'
        ];
    }
}
