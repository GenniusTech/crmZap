@extends('layout')
    @section('conteudo')
    <div class="login">
        <div class="container-login">
            <div class="wrap-login">
                <div class="login-pic">
                    <img src="{{ asset('home/logo.png') }}" alt="logo grupo sollution">
                </div>
                <form class="login-form">
                    <span class="login-form-title">
                        Atualize suas credenciais
                    </span>
                    <div class="wrap-input">
                        <input class="input-login" type="text" name="newpassword" placeholder="Nova senha">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input">
                        <input class="input-login" type="text" name="password" placeholder="Confirmar senha">
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
                </form>
            </div>
        </div>
    </div>
    @endsection