@extends('layout')
    @section('conteudo')
    <div class="login">
        <div class="container-login">
            <div class="wrap-login">
                <div class="login-pic">
                    <img src="{{ asset('home/logo.png') }}" alt="logo grupo sollution">
                </div>
                <form class="login-form" action="{{ route('sendMail') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <span class="login-form-title">
                        Esqueci minha senha
                    </span>

                    @if(session('errors') !== null)
                        <div style="background-color:lightgreen; color:rgb(8, 4, 4);text-align: center; border-radius:5px;">
                            {{session('errors')->first('message');}}
                        </div><br>
                    @endif
                    <div class="wrap-input">
                        <input class="input-login" type="text" name="email" autocomplete="off" placeholder="Email">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-form-btn">
                        <button class="login-form-btn">
                            Nova senha
                        </button>
                    </div>
                    <div class="text-center p-t-12">
                        <a class="txt1" href="{{ route('login')}}" target="_blank">
                            Acessar conta
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection