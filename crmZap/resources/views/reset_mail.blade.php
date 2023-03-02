@extends('layout')
    @section('conteudo')
    <div class="login">
        <div class="container-login">
            <div class="wrap-login">
                <div class="login-pic">
                    <img src="{{ asset('home/logo.png') }}" alt="logo grupo sollution">
                </div>
                <form class="login-form" @if(empty($erro)) method="POST" action="{{ route('updatePass') }}" @endif>
                    @if(session('errors')!== null)
                        <span>{{  session('errors')->first('message') }}</span>
                    @elseif(!empty($erro))
                        <span style="color:red;"><b>{!! $erro !!}</b></span><br>
                        <a href="{{  route('login') }}"><span>Fazer Login</span></a>
                    @else
                        <span class="login-form-title">
                            Atualize suas credenciais
                        </span>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $hash }}">

                        <div class="wrap-input">
                            <input class="input-login" type="password" name="password" placeholder="Nova senha">
                            <span class="focus-input"></span>
                            <span class="symbol-input">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input">
                            <input class="input-login" type="password" name="re_password" placeholder="Confirmar senha">
                            <span class="focus-input"></span>
                            <span class="symbol-input">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="container-form-btn">
                            <button class="login-form-btn">
                                Atualizar
                            </button>
                        </div>
                        <div class="text-center p-t-12">
                            <a class="txt1" href="signin.html" target="_blank">
                                Acessar conta
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @endsection