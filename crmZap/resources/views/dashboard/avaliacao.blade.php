@extends('dashboard.layout')
    @section('conteudo')
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5>Avaliações</h5>
                    <!-- <div class="search_chat">
                        <div>
                            <input type="text" placeholder="procurar contato">
                            <i class="bi bi-search"></i>
                        </div>
                    </div> -->
                    <!-- <i class="fa fa-upload pe-2 fs-5 text"></i> -->
                    <i class="fa fa-download fs-5 text"></i>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ChatId</th>
                                <th scope="col">Avaliação</th>
                                <th scope="col">Atendente</th>
                                <th scope="col">Origem Atendimento</th>
                                <th scope="col">Tipo Avaliação</th>
                                <th scope="col">Dt. inclusão</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($avaliacao as $avaliacoes)
                            <tr>
                                <th scope="row">{{ $avaliacoes->id }}</th>
                                <td>{{ $avaliacoes->chatId }}</td>
                                <td>{{ $avaliacoes->avaliação }}</td>
                                <td>{{ $avaliacoes->atendente }}</td>
                                <td>{{ $avaliacoes->origemAtendimento }}</td>
                                <td>{{ $avaliacoes->tipoAvaliação }}</td>
                                <td>{{ $avaliacoes->dataCriacao }}</td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection