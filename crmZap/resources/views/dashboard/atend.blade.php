@extends('dashboard.layout')
    @section('conteudo')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">

            <div class="col-sm-12 col-md-6 col-xl-12">
                <div class="card-setor h-100 bg-light rounded p-4">

                   @foreach ($atendente as $atend)
                    <div class="d-flex align-items-center p-3 bg-white mb-2">
                        <i class="bi bi-person-circle" style="font-size: 60px;"></i>
                        <div class="w-100 ms-3">
                            <div>
                                <h6 class="mb-0">{{ $atend->nome }}</h6>
                                <span>{{ $atend->email }}</span>
                                <p>{{ $atend->dep }}</p>
                                <a href="#modal-atendente" class="modal-setor-a">
                                    <i class="bi bi-pencil pe-2" style="font-size: 20px;"></i>
                                </a>
                                <a href="#modal-atendente-cancelar" class="modal-setor-a">
                                    <i class="bi bi-trash" style="font-size: 20px;"></i>
                                </a>
                            </div>     
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            
        </div>
    </div>
    
    <div id="modal-atendente" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Editar Atendente</h5>
            <hr>
            <form method="POST" action="">
                <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="tell" id="tell" placeholder="Telefone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="senha" id="senha" placeholder="Senha">
                    </div>
                </div>
                <label for="formFile" class="form-label">Selecione um ou mais departamentos</label>
                <select class="form-select" name="" aria-label="Default select example">
                    <option selected>Departamentos</option>
                    <option value="1">Limpa nome indenização</option>
                    <option value="2">Voo indenizado</option>
                    <option value="3">Limpa nome</option>
                    <option value="4">Score</option>
                </select>
                <div class="form-check form-switch pt-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        id="flexSwitchCheckDefault"
                    >
                    <label class="form-check-label" for="flexSwitchCheckDefault">Administrador</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
   
    <div id="modal-atendente-cancelar" class="modal-setor">
        <div class="modal-content-setor text-center">
            <i class="bi bi-exclamation-circle" style="font-size: 95px;"></i>
            <h3>Você tem certeza?</h3>
            <p>Tem certeza que deseja deletar esse atendente?</p>
            <div class="d-grid gap-2 d-md-flex justify-content-center">
                <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                <button class="btn btn-success" type="button">Deletar</button>
            </div>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    
    <div id="modal-criar-atendente" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Criar Atendente</h5>
            <hr>
            <form method="POST" action="{{ route('addAtend') }}">
                @csrf
                <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nome" id="inputName3" placeholder="Nome">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="tell" id="inputTelefone" placeholder="Telefone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="password" id="inputSenha" placeholder="Senha">
                    </div>
                </div>
                <label for="formFile" class="form-label">Selecione um ou mais departamentos</label>
                <select class="form-select" name="dep" aria-label="Default select example">
                    <option selected>Departamentos</option>
                    @foreach ($deplist as $dep)
                         <option value="{{ $dep->nome }}">{{ $dep->nome }}</option>
                    @endforeach
                   
                </select>
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="tipo" value="1">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Administrador</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"  name="status" value="1">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

    <a href="#modal-criar-atendente" class="btn btn-lg btn-lg-square back-to-top">
        <i class="fa fa-plus"></i>
    </a>
    @endsection