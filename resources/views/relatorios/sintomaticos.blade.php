@extends('template')

@section('titulo', 'Sintomáticos')




@section('conteudo')
<div class="user-data m-b-30">
        <h3 class="title-3 m-b-30">
            <i class="zmdi zmdi-account-calendar"></i>Sintomáticos</h3>
        

        <form action="{{route('relatorio.sintomaticos')}}">
            <div class="form-busca">
                <!-- BUSCAR -->
                <div class="input-busca">
                    <input type="text" name="buscar" value="{{$buscar}}" placeholder="Buscar..." class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </form>

        <div class="table-responsive table-data">
                @if(session('sucesso'))
                <div class="alert alert-success" role="alert" style="margin:0px 10px">
                    {{session('sucesso')}}
                </div>
                @endif
            <table class="table">
                <thead>
                    <tr>
                        <td>Nome/Email</td>
                        <td>Quantidade de Sintomas</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sintomaticos as $sintomatico)
                    <tr>
                        <!-- NOME -->
                        <td>
                            <div class="table-data__info">
                                <h6>{{$sintomatico['paciente']->nome}}</h6>
                                <span>
                                    <a href="#">{{$sintomatico['paciente']->email}}</a>
                                </span>
                            </div>
                        </td>
                        <!-- SINTOMAS -->
                        <td>
                            <ol>
                            @foreach($sintomatico['sintomas'] as $sintoma)
                                <li>
                                    <h6>{{$sintoma->sintoma}}</h6>
                                    <p>Vacina: {{$sintoma->vacina->vacina}}</p>
                                    <p>Data da vacina: {{date('d/m/Y', strtotime($sintoma->vacina->dose1_data))}}</p>
                                    <p>Data do sintoma: {{date('d/m/Y', strtotime($sintoma->data_ocorrencia))}}</p>
                                
                                </li>
                            @endforeach
                            <ol>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        <!-- Paginação -->
        <div style="padding:10px">{{$usuarios->links()}}</div>
        
        </div>
      
    </div>
@endsection