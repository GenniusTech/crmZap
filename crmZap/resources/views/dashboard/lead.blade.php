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
                            <th scope="col">ChatId</th>
                            <th scope="col">Dt. inclusão</th>
                            <th scope="col">Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Ana Júlia</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Larissa</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Fred</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Arthur</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Alice</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Lucas</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Yasmin</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>Juliana</td>
                            <td>exemploemail@gmail.com</td>
                            <td>84 90000-0000</td>
                            <td>Whatsapp</td>
                            <td>48161654</td>
                            <td>10/02/2023 14:19</td>
                            <td>8</td>
                        </tr>
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
            <form>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" placeholder="E-mail">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Telefone">
                    </div>
                </div>
                <label for="formFile" class="form-label">Selecione a origem:</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>WhatsApp</option>
                </select>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-4">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" type="button">Salvar</button>
                </div>
            </form>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    <!-- Modal Criar novo Lead -->
    
    @endsection