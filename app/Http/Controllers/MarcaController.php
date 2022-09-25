<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Marca;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    protected $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = $this->marca->getAll();
        return response()->json($marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaRequest $request)
    {
        try {
            $create = $this->marca->store($request->validated());
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
            $marca = $this->marca->findById($id);
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
    public function update(UpdateMarcaRequest $request, $id)
    {
        try {
            $marca = $this->marca->updateById($request->validated(), $id);
            return response()->json($marca);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao editar registro'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $delete = $this->marca->deleteById($id);
            return response()->json($delete);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao deletar registro'], 500);
        }
    }

}
