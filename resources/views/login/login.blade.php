@extends('login.template')
@section('conteudo_principal')
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{asset('images/icon/cit.png')}}" style="height: 200px" alt="Centro de Inovação Tecnológica">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{route('logar')}}" method="post">
                                @csrf
                                @if (session('erro'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('erro')}}
                                </div>
                                @endif

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="au-input au-input--full" type="password" name="senha" placeholder="Senha">
                                </div>
                               
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Logar</button>
                            </form>
                        </div>
                    </div>
@endsection