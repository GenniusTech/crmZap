@extends('dashboard.layout')
    @section('conteudo')
    <div class="col-12 h-100">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h5>Contatos</h5>
                <div class="search_chat">
                    <div>
                        <input type="text" class="w-75" placeholder="procurar contato">
                    </div>
                </div>
                <i class="bi bi-search"></i>
            </div>
            <div class="table-responsive">
                <table id="tabela" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Dt. inclusão</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        @foreach ($contatos as $contato)
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ $contato->nome }}</th>
                            <th scope="col">{{ $contato->email }}</th>
                            <th scope="col">{{ $contato->tell }}</th>
                            <th scope="col">{{ $contato->dataCriacao }}</th>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div id="modal-novo-contato" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Criar novo contato</h5>
            <hr>
            <form method="POST" action="{{ route('adicionar_contato') }}">
                @csrf
                <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Primeiro nome">
                    </div>
                    <div class="col">
                        <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Último nome">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" id="tell" name="tell" class="form-control"placeholder="Telefone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" id="empresa" name="empresa" class="form-control"placeholder="CNPJ ou CPF">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" id="profissao" name="profissao" class="form-control"placeholder="Profissão">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook">
                    </div>
                    <div class="col">
                        <input type="text" id="instagram" name="instagram" class="form-control" placeholder="Instagram">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" id="btnCadastrar" type="submit">Salvar</button>
                </div>
            </form>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

    <a href="#modal-novo-contato" class="btn btn-lg btn-lg-square back-to-top">
        <i class="fa fa-plus"></i>
    </a>

   

    @endsection