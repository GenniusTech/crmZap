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
                                <a href="#modal-atendente" class="open-modal-atendente" data-atend-id="{{ $atend->id }}">
                                    <i class="bi bi-pencil pe-2" style="font-size: 20px;"></i>
                                </a>
                                <a href="#modal-atendente-cancelar" class="modal-setor-a" data-atend-id="{{ $atend->id }}">
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
            <form>
                <input type="hidden" name="_token" id="token" value={{ csrf_token() }}>
                
                <input type="hidden" class="form-control" id="id" name="id">

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
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                    </div>
                </div>
                <label for="formFile" class="form-label">Selecione um ou mais departamentos</label>
                <select class="form-select" name="dep" id="dep" aria-label="Default select example">
                    @foreach ($deplist as $dep)
                        <option value="{{ $dep->nome }}">{{ $dep->nome }}</option>
                    @endforeach
                </select>
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="tipo" name="tipo" value="1">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Administrador</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="status"  name="status" value="1">
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
                <button class="btn btn-danger me-md-2" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success btn-confirmar-exclusao" type="button">Deletar</button>
            </div>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

   <script >
            $('#modal-atendente form').submit(function(e) {
                e.preventDefault(); // evita que o formulário seja enviado por submit padrão

                // captura os dados do formulário
                var depID =$('#modal-atendente #id').val();
                var nome = $('#modal-atendente #nome').val();
                var tell = $('#modal-atendente #tell').val();
                var dep = $('#modal-atendente #dep').val();
                var email = $('#modal-atendente #email').val();
                var senha = $('#modal-atendente #senha').val();
                var tipo = $('#modal-atendente #tipo').prop('checked') ? 1 : 2;
                var status = $('#modal-atendente #status').prop('checked') ? 1 : 2;
                var token = $('#modal-atendente #token').val()

                const dados = {
                    nome: nome,
                    tell: tell,
                    email: email,
                    senha: senha,
                    dep: dep,
                    tipo: tipo,
                    status: status,
                    token: token
                };

                // envia a requisição AJAX
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: '/atend/edit/'+depID,
                    method: 'PUT',
                    data: dados,
                    success: function(data) {
                        alert("Atendente atualizado com sucesso!");
                        window.location.href = "{{ route('atend') }}";
                    },
                    error: function(xhr, status, error) {
                        alert("Falha ao editar o Atendente!");
                    }
                });
            });
            $(document).ready(function() {
                $('.open-modal-atendente').click(function() {
                    var depID = $(this).data("atend-id");
                        $.ajax({
                            url: '/atend/show/'+depID,
                            method: "GET",
                            success: function(data) {
                                console.log(data.data[0].dep);
                                // preenche os campos do formulário no modal com as informações do departamento
                                console.log(data.data[0]);
                                $("#modal-atendente #id").val(depID);
                                $("#modal-atendente #nome").val(data.data[0].nome);
                                $("#modal-atendente #tell").val(data.data[0].tell);
                                $("#modal-atendente #email").val(data.data[0].email);
                                $("#modal-atendente #dep").val(data.data[0].dep);
                                
                                if (data.data[0].tipo === 1) {
                                    $("#modal-atendente #tipo").prop("checked", data.data[0].tipo);
                                }

                                if (data.data[0].status === 1) {
                                    $("#modal-atendente #status").prop("checked", data.data[0].status);
                                }
                                // $("#modal-atendente #status").val(data.data[0].status);
                            }
                        });
                });

                $('.modal-setor-a').click(function() {
                    var id = $(this).data('atend-id');
                    
                    $(".btn-confirmar-exclusao").data("id",id);
                });
       

                // Evento de clique no botão de confirmação de exclusão
                $('.btn-confirmar-exclusao').on('click', function() {
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        url: '{{ route('atendDestroy', ':id') }}'.replace(':id', id),
                        type: 'POST',
                        data: {_token: '{{ csrf_token() }}'},
                        success: function(data) {
                            // Exibição da mensagem de sucesso e recarregamento da página
                            alert('Atendente e usuário excluídos com sucesso.');
                            window.location.href='{{ route('atend') }}';
                        },
                        error: function(xhr, status, error) {
                            // Exibição da mensagem de erro
                            alert('Ocorreu um erro ao excluir o atendente e usuário.');
                        }
                    });
                });
            });

</script>
    
    <div id="modal-criar-atendente" class="modal-setor">
        <div class="modal-content-setor">
            <h5>Criar Atendente</h5>
            <hr>
            <form method="POST" action="{{ route('addAtend') }}">
                @csrf
                <i class="bi bi-person-circle" style="font-size: 50px;"></i>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nome" id="inputName3" placeholder="Nome" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="tell" id="inputTelefone" placeholder="Telefone" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="senha" id="inputSenha" placeholder="**********" required>
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