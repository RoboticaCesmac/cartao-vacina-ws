@extends('login.template')

@section('conteudo_principal')
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <img src="{{asset('images/icon/cit.png')}}" style="height: 100px" alt="CESMAC">
                </a>
            </div>
            <div class="login-form">
                <h2>Sua senha foi recuperda</h2>
                <p>Acesse o aplicativo com sua nova senha</p>
            </div>
        </div>
@endsection