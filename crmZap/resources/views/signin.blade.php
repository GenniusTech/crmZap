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
                        Login
                    </span>

                    <div class="wrap-input">
                        <input class="input-login" type="text" name="email" placeholder="Email">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input">
                        <input class="input-login" type="password" name="pass" placeholder="Senha">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-form-btn">
                        <button class="login-form-btn">
                            Entrar
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                                Esqueceu
                        </span>
                        <a class="txt2" href="#">
                                a senha?
                            </a>
                    </div>

                        <div class="text-center p-t-136">
                            <a class="txt2" href="signup">
                                Criar nova conta
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>
                </form>

            </div>
        </div>
    </div>
    @endsection