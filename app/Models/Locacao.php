<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;

    protected $table = 'locacoes';

    protected $fillable = [
        'cliente_id',
        'carro_id',
        'data_inicio_periodo',
        'data_final_periodo',
        'valor_diaria',
        'km_inicial',
        'data_final_previsto_periodo',
        'veiculo_entregue',
        'km_final',
    ];

    /**
     * Cria uma locacao
     * @param array $data
     * @return object
     */
    public function store(array $data)
    {
        return $this->create($data);
    }

    /**
     * Busca todas as locacaos disponiveis
     * @return object
     */
    public function getAll()
    {

        return $this->select(
            'id',
            'cliente_id',
            'carro_id',
            'data_final_previsto_periodo',
            'data_inicio_periodo',
            'data_final_periodo',
            'valor_diaria',
            'km_inicial',
            'km_final',
            'veiculo_entregue'
        )->get();
    }

    /**
     * Busca uma locacao especifica pelo id
     * @param int $id
     * @return object
     */
    public function findById($id)
    {
        return $this->select(
            'id',
            'cliente_id',
            'carro_id',
            'data_inicio_periodo',
            'data_final_previsto_periodo',
            'data_final_periodo',
            'valor_diaria',
            'km_inicial',
            'km_final',
            'veiculo_entregue'
        )->where('id', $id)->first();
    }

    public function updateById(array $data, $id)
    {
        return $this->where('id', $id)->update($data);
    }

    public function deleteById($id)
    {
        return $this->where('id', $id)->delete();
    }
}
