@extends('template')

@section('titulo', 'Relatório Estatística')

@section('conteudo')
<div class="user-data m-b-30">
        <h3 class="title-3 m-b-30">
            <i class="zmdi zmdi-account-calendar"></i>Estatísticas
        </h3>

        <div id="filtros">
            <form>
                <input type="hidden" value="1" name="filtrar"/>
                <h4>Filtrar ocorrências</h4>
                <p>Intervalo da ocorrência:</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i> Data inicial
                                </div>
                                <input type="date" name="data_inicio" value="{{$dataInicio}}" placeholder="período inicial da busca" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i> Data Final
                                </div>
                                <input type="date" name="data_fim" value="{{$dataFim}}" placeholder="período final da busca" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i> Buscar
                    </button>
                </div>
            </form>
        </div>

        <!-- VACINAS -->
        <h2 class="secoes">Sintomas</h2>
        <div class="graficos-principais">
            <canvas id="gSintomas"></canvas>
        </div>
        <hr/>
        
        <!-- SINTOMAS -->
        <h2 class="secoes">Sintomas por Vácinas</h2>
        <div class="graficos-principais">
            <canvas id="gVacinas"></canvas>
        </div>
        <hr/>

        <div class="graficos-menores">
            <div><canvas id="gAstrazeneca"></canvas></div>
            <div><canvas id="gCoronavac"></canvas></div>

            <div><canvas id="gPeizer"></canvas></div>
            <div><canvas id="gModerna"></canvas></div>

            <div><canvas id="gOutros"></canvas></div>
        </div>

        <hr/>
    </div>

@push('css')
<style>
    .filtro-in-line { flex:1; display:flex; flex-direction: row;}
    #filtros {padding: 10px;}
    .secoes { text-align: center }
    .graficos-principais { display: flex; flex: 1; padding: 10px 5%; }
    .graficos-menores { display: flex; padding: 20px; flex-wrap: wrap; justify-content: space-around;}
    .graficos-menores div { width: 50%; margin-bottom: 50px; }
</style>
@endpush

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var gSintomas = document.getElementById('gSintomas').getContext('2d');
        var chart = new Chart(gSintomas, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $sintomas['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)', 'rgba(139, 58, 58, 0.7)', 'rgba(238, 0, 0, 0.7)', 'rgba(255, 193, 37, 0.7)'],
                        data: [{{join(',', array_slice($sintomas, 1))}}],
                    }
                ]
            },
           
            options: { title: { display: true, text: 'Quantidade de sintomas'}, scales: { yAxes: [{ ticks: { beginAtZero: true } }] }}
        });

        var gVacinas = document.getElementById('gVacinas').getContext('2d');
        var chart = new Chart(gVacinas, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $vacinas['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)', 'rgba(139, 58, 58, 0.7)', 'rgba(238, 0, 0, 0.7)', 'rgba(255, 193, 37, 0.7)'],
                        data: [{{join(',', array_slice($vacinas, 1))}}],
                    }
                ]
            },
           
            options: { title: { display: true, text: 'Quantidade de Sintomas'}, scales: { yAxes: [{ ticks: { beginAtZero: true } }] }}
        });

        var gAstrazeneca = document.getElementById('gAstrazeneca').getContext('2d');
        var chart = new Chart(gAstrazeneca, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $sintomas_1['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)'],
                        data: [{{join(',', array_slice($sintomas_1, 1))}}],
                    }
                ]
            },
            options: { title: { display: true, text: 'Sintomas Astrazeneca'}, scales: { display:false } }
        });

        var gCoronavac = document.getElementById('gCoronavac').getContext('2d');
        var chart = new Chart(gCoronavac, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $sintomas_2['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)'],
                        data: [{{join(',', array_slice($sintomas_2, 1))}}],
                    }
                ]
            },
            options: { title: { display: true, text: 'Sintomas Coronavac'}, scales: { display:false } }
        });
        
        var gPeizer = document.getElementById('gPeizer').getContext('2d');
        var chart = new Chart(gPeizer, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $sintomas_3['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)'],
                        data: [{{join(',', array_slice($sintomas_3, 1))}}],
                    }
                ]
            },
            options: { title: { display: true, text: 'Sintomas Peizer'}, scales: { display:false } }
        });
       
        var gModerna = document.getElementById('gModerna').getContext('2d');
        var chart = new Chart(gModerna, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $sintomas_4['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)'],
                        data: [{{join(',', array_slice($sintomas_4, 1))}}],
                    }
                ]
            },
            options: { title: { display: true, text: 'Sintomas Moderna'}, scales: { display:false } }
        });
        
        var gOutros = document.getElementById('gOutros').getContext('2d');
        var chart = new Chart(gOutros, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [{!!join(',', $sintomas_5['opcoes'])!!}],
                datasets: [
                    { 
                        backgroundColor: ['rgba(30, 144, 255, 0.7)', 'rgba(222, 184, 135, 0.7)', 'rgba(0, 255, 127, 0.7)', 'rgba(119, 136, 153, 0.7)', 'rgba(160, 32, 240, 0.7)', 'rgba(255, 255, 0, 0.7)'],
                        data: [{{join(',', array_slice($sintomas_5, 1))}}],
                    }
                ]
            },
            options: { title: { display: true, text: 'Sintomas Outras Vacinas'}, scales: { display:false } }
        });

    </script>
@endpush
@endsection