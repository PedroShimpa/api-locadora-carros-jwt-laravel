<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Locacao;
use App\Http\Requests\StoreLocacaoRequest;
use App\Http\Requests\UpdateLocacaoRequest;
use App\Models\Carro;
use Illuminate\Database\QueryException;


class LocacaoController extends Controller
{

    protected $locacao;
    protected $carro;

    public function __construct(Locacao $locacao, Carro $carro)
    {
        $this->locacao = $locacao;
        $this->carro = $carro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locacaos = $this->locacao->getAll();
        return response()->json($locacaos);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocacaoRequest $request)
    {
        try {
            $data = $request->validated();
            $this->carro->makeCarAvailable($data['carro_id'], 0);
            $create = $this->locacao->store($data);
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
            $locacao = $this->locacao->findById($id);
            return response()->json($locacao);
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
    public function update(UpdateLocacaoRequest $request, $id)
    {
        try {
            $data = $request->validated();
            if (!empty($data['veiculo_entregue'])) {
                $data['data_final_periodo'] = now()->format('Y-m-d');
                $this->carro->makeCarAvailable($data['carro_id'], 1, $data['km_final']);
            }

            $locacao = $this->locacao->updateById($data, $id);
            return response()->json($locacao);
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
            $delete = $this->locacao->deleteById($id);
            return response()->json($delete);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro inesperado ao deletar registro'], 500);
        }
    }
}
