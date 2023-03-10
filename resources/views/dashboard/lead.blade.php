@extends('dashboard.layout')
    @section('conteudo')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h5>Leads</h5>
                <div class="search_chat">
                    <div>
                        <input type="text" placeholder="procurar contato">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
                <i class="fa fa-upload pe-2 fs-5 text"></i>
                <i class="fa fa-download fs-5 text"></i>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Origem</th>
                            <th scope="col">Dt. inclusão</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leadlist as $lead)
                        <tr>
                            
                            <th scope="row">{{ $lead->id }}</th>
                            <td>{{ $lead->nome }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->tell }}</td>
                            <td>{{ $lead->origem }}</td>
                            <td>{{ $lead->dataCriacao }}</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Tabela Leads -->

    <!-- Modal Criar novo Lead -->
    <div id="modal-novo-lead" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Criar Lead</h5>
            <hr>
            <form method="POST" action="{{ route('addLead') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="tell" class="form-control" placeholder="Telefone" required>
                    </div>
                </div>
                <label for="formFile" class="form-label">Selecione a origem:</label>
                <select class="form-select" name="origem" aria-label="Default select example" required>
                    <option selected>WhatsApp</option>
                </select>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-4">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    <!-- Modal Criar novo Lead -->
    <a href="#modal-novo-lead" class="btn btn-lg btn-lg-square back-to-top">
        <i class="fa fa-plus"></i>
    </a>
    @endsection