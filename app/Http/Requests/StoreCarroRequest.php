<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarroRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'modelo_id' =>  ['required', 'integer', Rule::exists('modelos', 'id')
                ->where('id', $this->modelo_id)],
            'placa' => ['required', 'max:10', 'unique:carros'],
            'disponivel' => ['boolean'],
            'km' => ['required', 'integer']
        ];
    }
}
