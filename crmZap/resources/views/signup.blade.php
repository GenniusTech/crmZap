@extends('layout')
    @section('conteudo')
    <div class="login">
        <div class="container-login">
            <div class="wrap-login">
                <div class="login-pic signup-pic">
                    <img src="{{ asset('home/logo.png') }}" alt="logo grupo sollution">
                </div>

                <form class="login-form">
                    <span class="login-form-title">
                        Criar nova conta
                    </span>

                    <div class="wrap-input">
                        <input class="input-login" type="text" name="text" placeholder="Nome *" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-regular fa-user"></i>
                        </span>
                    </div>

                    <div class="wrap-input">
                        <input class="input-login" type="text" name="email" placeholder="Email *" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input">
                        <input class="input-login" type="number" name="number" placeholder="Telefone *" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-phone"></i>
                        </span>
                    </div>

                    <div class="wrap-input">
                        <input class="input-login" type="password" name="pass" placeholder="Senha *" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-form-btn">
                        <button class="login-form-btn">
                            Criar
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Já tenho uma conta?
                        </span>
                        <a class="txt2" href="/">
                            Entrar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection