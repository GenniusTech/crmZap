@extends('dashboard.layout')
    @section('conteudo')
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">

                <div class="col-sm-12 col-md-6 col-xl-12">
                    <div class="card-setor h-100 bg-light rounded p-4">
                        @foreach ($deplist as $dep)
                        <div class="d-flex align-items-center p-3 bg-white mb-2">
                            <i class="bi bi-person-circle" style="font-size: 60px;"></i>
                            <div class="w-100 ms-3">
                                <div>
                                    <h6 class="mb-0">{{ $dep->nome }}</h6>
                                    <span>{{ $dep->segmento }}</span>
                                    <p>{{ $dep->resp }}</p>
                                    <a href="#modal-setor" class="modal-setor-a">
                                        <i class="bi bi-pencil pe-2" style="font-size: 20px;"></i>
                                    </a>
                                    <a href="#modal-setor-cancelar" class="modal-setor-a" data-dep-id="{{ $dep->id }}">
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

        <a href="#modal-criar-setor" class="btn btn-lg btn-lg-square back-to-top">
            <i class="fa fa-plus"></i>
        </a>
      
        <div id="modal-setor" class="modal-setor">
            <div class="modal-content-setor">
                <h5>Editar Departamento</h5>
                <hr>
                <form>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputName3" placeholder="Nome">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputSegmento" placeholder="Segmento">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputResponsável" placeholder="Responsável">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Listar departamento no bot</label>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                        <button class="btn btn-success" type="button">Salvar</button>
                    </div>
                </form>
                <a href="#" class="modal__close">&times;</a>
            </div>
        </div>

        <div id="modal-setor-cancelar" class="modal-setor">
            <div class="modal-content-setor text-center">
                <i class="bi bi-exclamation-circle" style="font-size: 95px;"></i>
                <h3>Você tem certeza?</h3>
                <p>Tem certeza que deseja deletar esse departamento?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-center">
                    <button class="btn btn-danger me-md-2" type="button" data-dismiss="modal">Cancelar</button>
                    <a href="{{ route('deleteDep', ['id' => '__DEP_ID__']) }}" class="btn btn-success btn-confirm-delete">Deletar</a>
                    <input type="hidden" id="dep-id" name="dep-id" value="">
                </div>
                <a href="#" class="modal__close">&times;</a>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Atualiza a URL do botão "Deletar" com o ID do departamento selecionado
                $('.modal-setor-a').click(function() {
                    var depId = $(this).data('dep-id');
                    $('#dep-id').val(depId);
                    var url = $('.btn-confirm-delete').attr('href').replace('__DEP_ID__', depId);
                    $('.btn-confirm-delete').attr('href', url);
                });
            });
        </script>

        <div id="modal-criar-setor" class="modal-setor">
            <div class="modal-content-setor">
                <h5>Criar Departamento</h5>
                <hr>
                <form method="POST" action="{{ route('addDep') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="segmento" id="segmento " placeholder="Segmento">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="resp" id="resp" placeholder="Responsável">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="status" id="status" placeholder="status">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Listar departamento no bot</label>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-danger me-md-2" type="button">Cancelar</button>
                        <button class="btn btn-success" id="btnCadastrar" type="submit">Salvar</button>
                    </div>
                </form>
                <a href="#" class="modal__close">&times;</a>
            </div>
        </div>
    @endsection