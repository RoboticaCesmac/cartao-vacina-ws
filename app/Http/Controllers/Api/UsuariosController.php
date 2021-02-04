<?php

namespace App\Http\Controllers\Api;

use App\Mail\RecuperarSenha;
use App\Models\Usuario;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends ApiController {
    
     
    /** Loga o usuário */
    public function logar(Request $request) {
        $usuario = Usuario::where('email', $request->email)
                            ->firstOrFail(); //Senão achar retorna 404

        if (!Hash::check($request->senha, $usuario->senha))
            abort(404);

        $jwt = JWT::encode(['id' => $usuario->id], config('jwt.senha'));
        return response()->json(['jwt' => $jwt, 'usuario' => $usuario], 200);
    }

     /** Cadastra uma nova tarefa */
     public function cadastrar(Request $request) {
        $validation = Validator::make($request->usuario, [
            'nome'              => 'required',
            'email'             => 'required|email|unique:usuarios,email',
            'data_nascimento'   => 'required',
            'senha'             => 'required|min:6'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        } else {
            $usuario = $request->usuario;
            $usuario['senha'] = bcrypt($usuario['senha']);
            $usuario = Usuario::create($usuario);
            return response()->json($usuario, 201);
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
        
        if (isset($request->usuario['senha']))
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
