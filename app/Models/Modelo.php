<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;



    protected $fillable = [
        'nome',
        'marca_id',
        'imagem',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs',
    ];

    /**
     * Cria uma modelo
     * @param array $data
     * @return object
     */
    public function store(array $data)
    {
        return $this->create($data);
    }

    /**
     * Busca todas as modelos disponiveis
     * @return object
     */
    public function getAll()
    {
        return $this->select('id', 'nome','marca_id','imagem','numero_portas','lugares','air_bag','abs')->get();
    }

    /**
     * Busca uma modelo especifica pelo id
     * @param int $id
     * @return object
     */
    public function findById($id)
    {
        return $this->select('id', 'nome','marca_id','imagem','numero_portas','lugares','air_bag','abs')
        ->where('id', $id)
        ->first();
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
