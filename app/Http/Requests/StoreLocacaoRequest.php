<?php

namespace App\Http\Requests;

use App\Models\Carro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLocacaoRequest extends FormRequest
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
            'valor_diaria' => ['required'],
            'km_inicial' => ['required', 'integer'],
            'km_final' => ['nullable', 'integer'],
        ];
    }

    public function withValidator($validator) 
    {
    
        $validator->after(function ($validator) {

            $checkCar = new Carro();
            $disponivel = $checkCar->checkAsAvailable($this->carro_id);

            if(empty($disponivel)) {
                $validator->errors()->add('carro_id', 'Este carro não está dísponivel para aluguel!');
            }
        });
    }

}
