<?php

namespace App\Http\Controllers\Api;

use App\Models\Sintoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SintomasController extends ApiController {
    
     /** Cadastra uma nova sintoma */
     public function cadastrar(Request $request) {
        $pacienteID = $this->getUsuarioID($request);
        $validation = Validator::make($request->sintoma, [
            'tipo_id'           => 'required|integer',
            'vacina_id'         => 'required|integer',
            'data_ocorrencia'   =>  'required|date'
        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);
        $dados = $request->sintoma;
        $dados['paciente_id'] = $pacienteID;
        $sintoma = Sintoma::create($dados);
        return response()->json(['sintoma' => $sintoma], 201);
    }

    /** Retorna todas as sintomas de um paciente */
    public function buscar(Request $request) {
        $pacienteID = $this->getUsuarioID($request);
        $sintomas = Sintoma::where('paciente_id', $pacienteID)->get();
        return response()->json($sintomas, 200);
    }

    /** Edita a sintoma */
    public function editar(Request $request, int $id) {
        $pacienteID = $this->getUsuarioID($request);
        $sintoma = Sintoma::where('id', $id)->where('paciente_id', $pacienteID)->firstOrFail();
        
        $pacienteID = $this->getUsuarioID($request);
        $validation = Validator::make($request->sintoma, [
            'tipo_id'          => 'required|integer',
            'vacina_id'        => 'required|integer',
            'data_ocorrencia'   =>  'required|date'

        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);

        $dados = $request->sintoma;
        unset($dados['id']);
        unset($dados['paciente_id']);

        $sintoma->fill($dados);
        $sintoma->save();
        return response()->json(['sintoma' => $sintoma], 200);
    }

    /** Remove uma sintoma */
    public function excluir(Request $request, int $id) {
        $pacienteID = $this->getUsuarioID($request);
        $sintoma = Sintoma::where('id', $id)->where('paciente_id', $pacienteID)->firstOrFail();

        $sintoma->delete();
        return response()->json(['sucesso' => true], 200);
    }
}
