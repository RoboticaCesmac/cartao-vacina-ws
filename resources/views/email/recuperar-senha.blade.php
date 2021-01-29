<h1>Recupera Senha</h1>

<p>Olá {{$usuario->nome}}, caso você tenha solicitado a recuperação de senha do aplicativo <b>Cartão de Vacina</b>, clique no clique no link abaixo:</p>

<a href="{{route('senha.recuperar', ['token' => $token])}}">{{route('senha.recuperar', ['token' => $token])}}</a>

<p>Centro de Inovação Tecnológica - CESMAC</p>