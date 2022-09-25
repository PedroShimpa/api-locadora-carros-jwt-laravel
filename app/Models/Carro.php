<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo_id',
        'placa',
        'disponivel',
        'km',
    ];
    /**
     * Cria uma carro
     * @param array $data
     * @return object
     */
    public function store(array $data)
    {
        return $this->create($data);
    }

    /**
     * Busca todas as carros disponiveis
     * @return object
     */
    public function getAll()
    {

        return $this->select('id',  'modelo_id', 'placa', 'disponivel', 'km')->get();
    }

    /**
     * Busca uma carro especifica pelo id
     * @param int $id
     * @return object
     */
    public function findById($id)
    {
        return $this->select('id', 'modelo_id', 'placa', 'disponivel', 'km')->where('id', $id)->first();
    }

    public function updateById(array $data, $id)
    {
        return $this->where('id', $id)->update($data);
    }

    public function deleteById($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function checkAsAvailable($carroId)
    {
        return $this->where('id', $carroId)->where('disponivel', 1)->first();
    }

    public function makeCarAvailable($carroId, $available, $km = 0)
    {
        $update = [
            'disponivel' => $available
        ];

        if(!empty($km)) {
            $update['km'] = $km;
        }
        return $this->where('id', $carroId)->update($update);
    }
}
