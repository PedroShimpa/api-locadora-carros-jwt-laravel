<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
    ];

    /**
     * Cria uma cliente
     * @param array $data
     * @return object
     */
    public function store(array $data)
    {
        return $this->create($data);
    }

    /**
     * Busca todas as clientes disponiveis
     * @return object
     */
    public function getAll()
    {

        return $this->select('id', 'nome')->get();
    }

    /**
     * Busca uma cliente especifica pelo id
     * @param int $id
     * @return object
     */
    public function findById($id)
    {
        return $this->select('id', 'nome')->where('id', $id)->first();
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
