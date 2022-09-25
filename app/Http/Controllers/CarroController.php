<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;
use Illuminate\Database\QueryException;

class CarroController extends Controller
{

    protected $carro;

    public function __construct(Carro $carro)
    {
        $this->middleware('auth:api');
        $this->carro = $carro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carros = $this->carro->getAll();
        return response()->json($carros);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarroRequest $request)
    {
        try {
            $create = $this->carro->store($request->validated());
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
            $carro = $this->carro->findById($id);
            return response()->json($carro);
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
    public function update(UpdateCarroRequest $request, $id)
    {
        try {
            $carro = $this->carro->updateById($request->validated(), $id);
            return response()->json($carro);
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
            $delete = $this->carro->deleteById($id);
            return response()->json($delete);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao deletar registro'], 500);
        }
    }
}
