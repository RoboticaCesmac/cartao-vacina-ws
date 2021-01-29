<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

/**
 * Tela resposável por manipular as ações das telas de Login
 */
class LoginController extends Controller {
    
    /** Abre a tela Inicial de Login */
    public function index() {
        return view('login.login');
    }

    /** Faz com o que o usuário tente realizar o login */
    public function logar(Request $request) {
        $usuario = Usuario::where('email', $request->email)
                            ->where('admin', true)->first();
        if ($usuario != null && Hash::check($request->senha, $usuario->senha) ) {
            session(['usuario' => $usuario]);
            return redirect()->route('dashboard');
        } else
            return redirect()->back()->with(['erro' => 'Login ou Senha incorreta']);
    }

    /** Recuperar Senha */
    public function recuperarSenha(Request $request) {
        try {
            $dados = JWT::decode($request->token, config('jwt.senha'), ['HS256']);
            if ($dados->exp < time()) abort(404); //Link expirou
            
            return view('login.recuperar-senha', ['token' => $request->token]);

        } catch(\Exception $e) {
            abort(404);
        } 
    }

    /** Salva o recuperar senha */
    public function salvarNovaSenha(Request $request) {
        //Valida a senha
        $request->validate([
            'senha'  => 'required|min:6'
        ]);

        try {
            //Valida o token
            $dados = JWT::decode($request->token, config('jwt.senha'), ['HS256']);
            if ($dados->exp < time()) abort(404); //Link expirou
            
            Usuario::where('id', $dados->id)->update(['senha' => bcrypt($request->senha)]);

            return view('login.senha-recuperada');
        } catch(\Exception $e) {
            echo $e->getMessage();die;
            abort(404);
        }    
    }

    /** Função para deslogar o usuário */
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
