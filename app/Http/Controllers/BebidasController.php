<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bebidas;
use Illumminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Controllers;

class BebidasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosBebidas = Bebidas::All();
        $contador = $dadosBebidas->count();

        return 'Bebidas: '. $contador. $dadosBebidas .Response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosBebidas = $request->All();

        $valida = Validator::make($dadosBebidas, [
            'nomeBebida'=> 'required',
            'marcaBebida'=> 'required',
        ]);

        if($valida->fails()){
            return 'Dados inválidos'.$valida->errors(true). 500;
        }

        $bebidasBanco = Bebidas::create($dadosBebidas);

        if($bebidasBanco){
            return 'Bebidas cadastradas '.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'Bebidas não cadastradas '.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bebidasBanco = Bebidas::find($id);
        $contador = $bebidasBanco->count();

        if($bebidasBanco){
            return 'Bebidas encontradas: '.$contador.' - '.$bebidasBanco.response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'Bebidas não encontradas.'.response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bebidasBanco = $request->All();
        $valida = Validator::make($bebidasBanco,[
            'nomeBebida' => 'required',
            'marcaBebida' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $registroBebidas = Bebidas::save($bebidasBanco);
        if($registroBebidas){
            return 'Dados cadastrados com sucesso.';
        }else{
            return 'Dados não cadastrados no banco de dados.';
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bebidasBanco = Bebidas::find($id);
        if($bebidasBanco){
            $bebidasBanco->delete();
            return 'A bebida foi deletada com sucesso.'.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'A bebida não foi deletada com sucesso.'.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }
}
