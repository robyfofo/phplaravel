<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateRequest extends FormRequest
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
        'dateins' => 'required|date_format:d/m/Y',
        'datesca' => 'required|date_format:d/m/Y',
        'note' => 'required',
        'content' => 'required',
        /*
        'completato' => 'required|numeric|min:0|max:100',
        'costo_orario' => 'required|numeric|between:0,99.99',
        'ore_preventivo' => 'required|numeric|between:0,10000',
        */

      ];
  }

  public function messages()
  {
    return [

      'dateins.required' => 'La data è richiesta.',
      'dateins.date_format' => 'La data è in formato errato.',

      'datesca.required' => 'La scadenza è richiesta.',
      'datesca.date_format' => 'La scadenza è in formato errato.',

      'note.required' => 'Il campo note è richiesto.',
      'content.required' => 'Il campo contenuto è richiesto.',
      /*
      'status.numeric' => 'Il campo status deve essere numerico.',
      'completato.required' => 'Il campo completato è richiesto.',
      'completato.numeric' => 'Il campo completato deve essere numerico.',
      'completato.max' => 'Il campo status non deve essere maggiore di 100.',
      
      'costo_orario.required' => 'Il campo costo orario è richiesto.',
      'costo_orario.max' => 'Il campo costo orario non deve essere maggiore di 100.',
      
      'ore_preventivo.numeric' => 'Il campo ore preventivo deve essere numerico.',
      */
      
    ];
  }
}
