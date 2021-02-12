<?php

namespace App\Http\Controllers;

use App\Models\Sintoma;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    private $dados = ['menu' => 'relatorios'];
    /**
     * Lista os pacientes que apresentaram algum sintoma
     */
    public function sintomaticos(Request $request) {
        $this->dados['buscar'] = $request->buscar;
        //Buscando os sintomaticos
        $sintomaticos = DB::table('usuarios as u')->join('sintomas as s', 'u.id', '=', 's.paciente_id');
        
        //Filtro de Busca
        if ($request->buscar)
            $usuario = $sintomaticos->where('nome', 'like', '%'.$request->buscar.'%')
                                ->orWhere('email', 'like', '%'. $request->buscar.'%');
        $this->dados['usuarios'] = $sintomaticos->select('u.id')->groupBy('u.id')->paginate(10);

        $this->dados['sintomaticos'] = [];
        foreach($this->dados['usuarios'] as $usuario) {
            
            $this->dados['sintomaticos'][$usuario->id] = [
                'paciente'  => Usuario::find($usuario->id),
                'sintomas'  => Sintoma::with('vacina')->where('paciente_id', $usuario->id)->get()
            ];
        }

        return view('relatorios.sintomaticos', $this->dados);
    }

    /**
     * Apresenta relatórios estatisticos sobre as vacinas
     */
    public function estatisticas(Request $request) {
        $this->dados['buscar'] = $request->buscar;
        
        return view('relatorios.sintomaticos', $this->dados);
    }
}
