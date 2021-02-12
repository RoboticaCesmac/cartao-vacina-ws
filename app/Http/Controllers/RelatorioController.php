<?php

namespace App\Http\Controllers;

use App\Models\Sintoma;
use App\Models\Usuario;
use App\Models\Vacina;
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

    // ============================================= ESTATISTICA ========================================= //
    /** 
     * Apresenta relatórios estatisticos sobre as vacinas
    */
    public function estatisticas(Request $request) {

        //BUSCANDO
        $sintomaModel = Sintoma::where('id', '>', '0');

        //Filtros
        if ($request->filtrar) {
            $dataInicio = $request->data_inicio;
            $dataFim = $request->data_fim;
            if ($dataInicio) $sintomaModel->where('data_ocorrencia', '>=', $dataInicio);
            if ($dataFim) $sintomaModel->where('data_ocorrencia', '<=', $dataFim);
        }
        $sintomas = $sintomaModel->get();

        //Organizando
        $this->dados= [
            'dataInicio'    => $dataInicio ?? '',
            'dataFim'       => $dataFim ?? '',
            'total' => count($sintomas),
            'sintomas' => [
                'opcoes'  => ['"Tontura"', '"Dores"', '"Outro"'],
                1 => 0, 2 => 0, -1 => 0,
            ],
            'vacinas' => [
                'opcoes' => ['"Astrazeneca(Fiocruz)"', '"Coronavac(Butantan)"', '"Peizer"', '"Moderna"', '"Outro"'],
                1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0
            ],
            //astrazeneca
            'sintomas_1' => [ 
                'opcoes'  => ['"Tontura"', '"Dores"', '"Outro"'],
                1 => 0, 2 => 0, -1 => 0,
            ],
            //coronavac
            'sintomas_2' => [
                'opcoes'  => ['"Tontura"', '"Dores"', '"Outro"'],
                1 => 0, 2 => 0, -1 => 0,
            ],
            //peizer
            'sintomas_3' => [
                'opcoes'  => ['"Tontura"', '"Dores"', '"Outro"'],
                1 => 0, 2 => 0, -1 => 0,
            ],
            //moderna
            'sintomas_4' => [
                'opcoes'  => ['"Tontura"', '"Dores"', '"Outro"'],
                1 => 0, 2 => 0, -1 => 0,
            ],
            //outros
            'sintomas_5' => [
                'opcoes'  => ['"Tontura"', '"Dores"', '"Outro"'],
                1 => 0, 2 => 0, -1 => 0,
            ],

        ];

        //Sintomas e Vacinas
        foreach ($sintomas as $sintoma) {
            $this->dados['sintomas'][$sintoma->tipo_id]++;
            $this->dados['vacinas'][$sintoma->vacina->tipo]++;

            $this->dados['sintomas_'.$sintoma->vacina->tipo][$sintoma->tipo_id]++;
        }

        return view('relatorios.estatistica', $this->dados);


    }
}
