<?php

namespace App\Http\Requests;

use App\Http\Middleware\Admin as MiddlewareAdmin;
use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //strong password : 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            //'name'=> 'required|regex:/^[a-zA-Z]*$/i|max:255',
            'email'=>  'required|email',
            'password'=> ['required'],
           
        ];
      
    }
    public function messages(){
        return [
            'email.required' => 'We need to know your email address!',
            'password' => 'Password is required',
        ];
    }
}
