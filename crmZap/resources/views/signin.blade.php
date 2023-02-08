@extends('layout')
    @section('conteudo')
    <div class="login">
        <div class="container-login">
            <div class="wrap-login">
                <div class="login-pic">
                    <img src="{{ asset('home/logo.png') }}" alt="logo grupo sollution">
                </div>

                <form class="login-form" method="POST" action="{{ route('login_action') }}">
                    <input type="hidden" value={{  csrf_token() }} name="_token">
                    <span class="login-form-title">
                        Login
                       
                        
                    </span>

                    <div>
                        @if ($errors->any())
                        <div style="background-color: rgb(227, 112, 112); color:white;text-align: center; border-radius:5px;">
                            <ul class="alert alert-error">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div><br>

                    <div class="wrap-input">
                        <input class="input-login" type="text" name="email" placeholder="Email">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input">
                        <input class="input-login" type="password" name="senha" placeholder="Senha">
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