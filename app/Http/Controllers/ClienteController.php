<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Database\QueryException;

class ClienteController extends Controller
{

    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

   /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->cliente->getAll();
        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        try {
            $create = $this->cliente->store($request->validated());
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
            $cliente = $this->cliente->findById($id);
            return response()->json($cliente);
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
    public function update(UpdateClienteRequest $request, $id)
    {
        try {
            $cliente = $this->cliente->updateById($request->validated(), $id);
            return response()->json($cliente);
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
            $delete = $this->cliente->deleteById($id);
            return response()->json($delete);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao deletar registro'], 500);
        }
    }
}
