<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        'title' => 'required|string|max:255',
        'content' => 'required|string|max:65535',
        'price_unity' => 'required|numeric|between:0,10000.99',

        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ];
    }

    public function messages()
    {
      return [
      'title.required' => 'Il campo titolo è richiesto.',

      'content.required' => 'Il campo contenuto è richiesto.',
      
      'price_unity.required' => 'Il campo prezzo unitario è richiesto.',
      'price_unity.numeric' => 'Il campo prezzo unitario deve essere numerico.',
      'price_unity.between' => 'Il campo prezzo unitario deve essere compreso tra 0 a 10000.99.',
      ];
    }

}
