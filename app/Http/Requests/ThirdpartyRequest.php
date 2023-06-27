<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThirdpartyRequest extends FormRequest
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
        'email' => 'required|email',
        'telephone' => 'required|numeric|min:10',
       ];
    }

    public function messages()
    {
      return [
      'email.required' => 'Il campo email è richiesto.',
      'email.email' => 'Il campo email deve essere un indirizzo email valido.',

      'telephone.required' => 'Il campo telefono è richiesto.',
      'telephone.numeric' => 'Il campo telefono deve essere numerico.',
      'telephone.min' => 'Il campo telefono deve avere almeno 10 caratteri.',
      ];
    }

}
