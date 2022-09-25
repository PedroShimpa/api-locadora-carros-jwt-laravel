<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMarcaRequest extends FormRequest
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
        $ignoreSelf = Rule::unique('marcas')->ignore($this->id, 'id');
        return [
            'nome' => ['required', $ignoreSelf],
            'imagem' => ['required', 'max:100']
        ];
    }
}
