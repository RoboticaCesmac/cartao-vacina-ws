@extends('login.template')

@section('conteudo_principal')
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{asset('images/icon/ravvs.png')}}" style="height: 100px" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{route('senha.nova')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$token}}" name="token" />
                                
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label>Nova Senha</label>
                                    <input class="au-input au-input--full" type="password" name="senha" placeholder="Senha">
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Recuperar</button>
                            </form>
                        </div>
                    </div>
@endsection