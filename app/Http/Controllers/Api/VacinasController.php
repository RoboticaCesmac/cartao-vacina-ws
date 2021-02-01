<?php

namespace App\Http\Controllers\Api;

use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacinasController extends ApiController {

    /** Cadastra uma nova vacina */
    public function cadastrar(Request $request) {
        $pacienteID = $this->getUsuarioID($request);
        $validation = Validator::make($request->vacina, [
            'tipo'              => 'required',
            'dose1_data'        => 'required',
        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);
        $dados = $request->vacina;
        $dados['paciente_id'] = $pacienteID;
        $vacina = Vacina::create($dados);
        return response()->json(['vacina' => $vacina], 201);
    }

    /** Retorna todas as vacinas de um paciente */
    public function buscar(Request $request) {
        $pacienteID = $this->getUsuarioID($request);
        $vacinas = Vacina::where('paciente_id', $pacienteID)->get();
        return response()->json($vacinas, 200);
    }

    /** Edita a vacina */
    public function editar(Request $request, int $id) {
        $pacienteID = $this->getUsuarioID($request);
        $vacina = Vacina::where('id', $id)->where('paciente_id', $pacienteID)->firstOrFail();
        
        $pacienteID = $this->getUsuarioID($request);
        $validation = Validator::make($request->vacina, [
            'tipo'              => 'required',
            'dose1_data'        => 'required',
        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);

        $dados = $request->vacina;
        unset($dados['id']);
        unset($dados['paciente_id']);

        $vacina->fill($dados);
        $vacina->save();
        return response()->json(['vacina' => $vacina], 200);
    }

    /** Remove uma vacina */
    public function excluir(Request $request, int $id) {
        $pacienteID = $this->getUsuarioID($request);
        $vacina = Vacina::where('id', $id)->where('paciente_id', $pacienteID)->firstOrFail();

        $vacina->delete();
        return response()->json(['sucesso' => true], 200);
    }
}
