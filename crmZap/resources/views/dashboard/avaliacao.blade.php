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
                            <tr>
                                <th scope="row">1</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">8</th>
                                <td>48161654</td>
                                <td>Lorem Ipsum</td>
                                <td>Aline</td>
                                <td>Whatsapp</td>
                                <td>Lorem Ipsum</td>
                                <td>10/02/2023</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection