<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLocacaoRequest extends FormRequest
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
            'cliente_id' =>  ['required', 'integer', Rule::exists('clientes', 'id')
                ->where('id', $this->cliente_id)],
            'carro_id' => ['required', 'integer', Rule::exists('carros', 'id')
                ->where('id', $this->carro_id)],
            'data_inicio_periodo' => ['required', 'date_format:Y-m-d'],
            'data_final_previsto_periodo' => ['required', 'date_format:Y-m-d', 'after:data_inicio_periodo'],
            'veiculo_entregue' => ['nullable'],
            'valor_diaria' => ['required'],
            'km_inicial' => ['required', 'integer'],
            'km_final' => ['nullable', 'integer'],
        ];
    }
}
