<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
    return
      [
        'name' => 'required|string|max:255',
        'label' => 'required|string|max:255',
        'alias' => 'required|string|max:255',
        'code_menu' => 'required|json|max:65535',
      ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Il campo nome è richiesto.',
      'label.required' => 'Il campo label è richiesto.',
      'alias.required' => 'Il campo alias è richiesto.',
      'code_menu.required' => 'Il campo codice menu è richiesto.',

      'name.string' => 'Il campo nome deve essere una stringa.',
      'label.string' => 'Il campo label deve essere una stringa.',
      'alias.string' => 'Il campo alias deve essere una stringa.',

      'code_menu.json' => 'Il campo code menu deve essere un json.',

      'name.max' => 'Il campo nome non deve superare i 255 caratteri.',
      'label.max' => 'Il campo label non deve superare i 255 caratteri.',
      'alias.max' => 'Il campo alais non deve superare i 255 caratteri.',
      'code_menu.max' => 'Il campo code menu non deve superare i 65535 caratteri.',
    ];
  }
}
