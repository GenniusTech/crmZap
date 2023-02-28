@extends('dashboard.layout')
    @section('conteudo')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center border-bottom py-3">
                        <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">{{  Auth::user()->nome}}</h6>
                                <a href="#modal-senha-perfil">Alterar senha</a>
                            </div>
                            <span>{{  Auth::user()->email}}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2 pt-3">
                        <h6 class="mb-0">Contato</h6>
                    </div>
                    <div class="d-flex align-items-center py-3">
                        <i class="fa fa-envelope"></i>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">E-mail</h6>
                            </div>
                            <span>{{  Auth::user()->email}}</span>
                        </div>
                    </div>
                  
                    <div class="d-flex align-items-center py-3">
                        <i class="fa fa-globe"></i>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Status</h6>
                            </div>
                            <span>{{ $atendente->status === 1 ? 'Ativo' : 'Inativo'; }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center py-3">
                        <i class="fa fa-credit-card"></i>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Plano</h6>
                            </div>
                            <span>Premium(Mensal)</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center py-3">
                        <i class="fa fa-phone"></i>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Telefone</h6>
                            </div>
                            <span>{{ $atendente->tell}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modal-senha-perfil" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Alterar Senha</h5>
            <hr>
            <form method="POST" action="{{ route('alterarSenha') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="password" name="senhaAnterior" class="form-control" placeholder="Senha anterior" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="password" name="novaSenha" class="form-control" placeholder="Nova senha" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="password" name="confirmarSenha" class="form-control" placeholder="Confirme a nova senha" required>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
            
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    @endsection