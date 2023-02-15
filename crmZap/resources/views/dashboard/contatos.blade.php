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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div id="modal-novo-contato" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Criar novo contato</h5>
            <hr>
            <form>
                <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="primeiroNome" class="form-control" placeholder="Primeiro nome">
                    </div>
                    <div class="col">
                        <input type="text" name="segundoNome" class="form-control" placeholder="Último nome">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" placeholder="E-mail">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="telefone" class="form-control"placeholder="Telefone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="empresa" class="form-control"placeholder="CNPJ ou CPF">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="profissao" class="form-control"placeholder="Profissão">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="facebook" class="form-control" placeholder="Facebook">
                    </div>
                    <div class="col">
                        <input type="text" name="instagram" class="form-control" placeholder="Instagram">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                    <button class="btn btn-success" id="btnCadastrar" type="button">Salvar</button>
                </div>
            </form>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

    <a href="#modal-novo-contato" class="btn btn-lg btn-lg-square back-to-top">
        <i class="fa fa-plus"></i>
    </a>

    <script>
        
        window.addEventListener('load', table);

        function table(){
            const apiUrl = 'http://127.0.0.1:8000/api/listContato';
            const tabela = $('#table');
            $.ajax({
                url: apiUrl,
                method: 'GET'
            }).done((data) => {
                const table = $('tbody');
                $.each(data, (i, objeto) => {
                    const row = $('<tr>');
                    const id = $('<td>').text(objeto.id);
                    const nome = $('<td>').text(objeto.nome);
                    const email = $('<td>').text(objeto.email);
                    const telefone = $('<td>').text(objeto.tell);
                    const data = $('<td>').text(objeto.created_at);
                    row.append(id, nome, email, telefone, data);
                    table.append(row);
                });
                tabela.append(table);
            }).fail((jqXHR, textStatus, errorThrown) => {
                tabela.text(`Erro ao obter dados: ${errorThrown}`);
            });
        }

        $('#btnCadastrar').click( function(){
            let dados = {
                'nome': $('input[name=primeiroNome]').val() + ' ' + $('input[name=segundoNome]').val(),
                'email': $('input[name=email]').val(),
                'tell': $('input[name=telefone]').val(),
                'empresa': $('input[name=empresa]').val(),
                'profissao': $('input[name=profissao]').val(),
                'instagram': $('input[name=instagram]').val(),
                'facebook': $('input[name=facebook]').val(),
                'atendente_id': '1'
            }

            console.log(dados);

            const apiUrl = 'http://127.0.0.1:8000/api/addContato';
            $.post(apiUrl, dados, (response) => {
                alert(response);
                window.location.reload();
            }).fail((jqXHR, textStatus, errorThrown) => {
                window.location.reload();
            });

        });

    </script>

    @endsection