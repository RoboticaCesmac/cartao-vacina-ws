<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UsuariosController extends ApiController {
    
     
    /** Loga o usuário */
    public function logar(Request $request) {
        $usuario = Usuario::where('email', $request->email)
                            ->where('senha', md5($request->senha))
                            ->firstOrFail(); //Senão achar retorna 404

        $jwt = JWT::encode(['id' => $usuario->id], config('jwt.senha'));
        return response()->json(['jwt' => $jwt, 'usuario' => $usuario], 200);
    }

     /** Cadastra uma nova tarefa */
     public function cadastrar(Request $request) {
        $validation = Validator::make($request->paciente, [
            'nome'              => 'required',
            'email'             => 'required|email|unique:usuarios,email',
            'data_nascimento'   => 'required',
            'senha'             => 'required|min:6'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        } else {
            $paciente = $request->paciente;
            $paciente['senha'] = bcrypt($paciente['senha']);
            $paciente = Usuario::create($paciente);
            return response()->json($paciente, 201);
        }
    }

    /** Permite usuário atualizar os próprios dados */
    public function atualizar(Request $request) {
        $id = $this->getUsuarioID($request);
        $usuario = Usuario::findOrFail($id);

        $validation = Validator::make($request->usuario, [
            'nome'              => 'required',
            'email'             => 'required|email|unique:usuarios,email,'.$id,
            'senha'             => 'min:6'
        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);
        
        $dados = $request->usuario;
        unset($dados['id']);
        unset($dados['medico']);
        if (isset($dados['senha'])) unset($dados['senha']);

        $usuario->fill($dados);
        
        if ($request->usuario['senha'])
            $usuario->senha = bcrypt($request->usuario['senha']);

        $usuario->save();
        return response()->json($usuario, 200);
    }


    /** Recupera a senha do usuário */
    public function recuperarSenha(Request $request) {
        $usuario = Usuario::where('email', $request->email)->firstOrFail();

        $token = JWT::encode([
            'id'    => $usuario->id,
            'exp'   => time() + (60*60*2) //Link expira em 2h
        ], config('jwt.senha'));

        Mail::to($usuario->email)->send(new RecuperarSenha($usuario, $token));

        return response()->json(['sucesso' => true], 200);
    }
}
