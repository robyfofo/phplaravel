<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimecardRequest extends FormRequest
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
            'dateins' => 'required|date_format:d/m/Y',
            'project_id' => 'required|integer|gt:0',
            'starttime' => 'required|date_format:H:i',
            'endtime' => 'required|date_format:H:i',
       ];
    }


    public function messages()
    {
      return [
      'dateins.required' => 'La data è richiesta.',
      'dateins.date_format' => 'La data è in formato errato.',
      
      'project_id.required' => 'Il progetto è richiesto.',
      
      'starttime.required' => 'La data inizio è richiesta.',
      'starttime.date_format' => 'La ora inizio è in formato errato.',
      
      'endtime.required' => 'La data di fine è richiesta.',
      'endtime.date_format' => 'La ora fine è in formato errato.',
      

      ];
    }
}
