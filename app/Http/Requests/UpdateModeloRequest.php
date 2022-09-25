<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModeloRequest extends FormRequest
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

        $ignoreSelf = Rule::unique('modelos')->ignore($this->id, 'id');
        return [
            'nome' => ['required', 'max:30', $ignoreSelf],
            'marca_id' => ['required', 'integer', Rule::exists('marcas', 'id')
                ->where('id', $this->marca_id)],
            'imagem' => ['required', 'max:100'],
            'numero_portas' => ['integer'],
            'lugares' => ['integer'],
            'air_bag' => ['boolean'],
            'abs' => ['boolean'],
        ];
    }
}
