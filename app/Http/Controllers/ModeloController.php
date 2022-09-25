<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModeloRequest;
use App\Http\Requests\UpdateModeloRequest;
use App\Models\Modelo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ModeloController extends Controller
{

    protected $modelo;

    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelo = $this->modelo->getAll();
        return response()->json($modelo);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModeloRequest $request)
    {
        try {
            $create = $this->modelo->store($request->validated());
            return response()->json($create);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao incluir registro'], 500);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $marca = $this->modelo->findById($id);
            return response()->json($marca);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao buscar registro'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModeloRequest $request, $id)
    {
        try {
            $marca = $this->modelo->updateById($request->validated(), $id);
            return response()->json($marca);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao editar registro'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $delete = $this->modelo->deleteById($id);
            return response()->json($delete);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao deletar registro'], 500);
        }
    }
}
