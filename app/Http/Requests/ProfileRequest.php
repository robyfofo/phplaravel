<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
    public function rules()
    {
      return [
        'passwordnew' => 'required|min:8',
        'passwordck' => 'required|min:8',
        'passwordold' => 'required|min:8',     
      ];
    }
   

    public function messages()
    {
      return [
      'passwordnew.required' => 'Il campo nuova password è richiesto.',
      'passwordck.required' => 'Il campo verifica password è richiesto.',
      'passwordold.required' => 'Il campo vecchia password è richiesto.',
      
      'passwordnew.min' => 'Il campo vecchia password deve avere minimo 8 caratteri!.',
      'passwordck.min' => 'Il campo verifica password deve avere minimo 8 caratteri!.',
      'passwordold.min' => 'Il campo nuova password deve avere minimo 8 caratteri!.',
      ];
    }
}
