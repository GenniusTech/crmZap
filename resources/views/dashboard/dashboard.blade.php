@extends('dashboard.layout')
    @section('conteudo')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card-leads rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-address-book fa-3x"></i>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $contactsCount }}</h6>
                        <p class="mb-2">Contatos</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-leads rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x"></i>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $count_atendente }}</h6>
                        <p class="mb-2"> {{ $tema }} </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-leads rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-comment-dots fa-3x"></i>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $leadsCount }}</h6>
                        <p class="mb-2">Conversas em andamento</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-leads rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-comment-slash fa-3x"></i>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $leadsStatusCount }}</h6>
                        <p class="mb-2">Conversas Finalizadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($tipo === 1)
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h5 class="mb-4">Atendentes</h5>
                <a href="{{ Route('atend') }}" class="link-atendente">Ir para atendentes<i class="fa fa-arrow-right ps-1"></i></a>
            </div>
            
            <div class="owl-carousel atendente-carousel">
            @foreach ($atendentes as $atendente)
                <div class="atendente-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">{{ $atendente->nome }}</h5>
                    <p class="mb-0">
                        <i class="fa fa-star"></i>
                        {{ $atendente->leads->count()}} conversas em andamento
                    </p>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h5 class="mb-4">Whatsapp</h5>
                <a href="{{ Route('contato') }}" class="link-atendente">Ir para Whatsapp<i class="fa fa-arrow-right ps-1"></i></a>
            </div>
            <div class="owl-carousel whatsapp-carousel">
                @foreach ($contatos as $contato)
                <div class="whatsapp-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">{{ $contato->nome }}</h5>
                    <p class="mb-0">
                        <i class="bi bi-phone"></i>
                        Conectado
                    </p>
                </div>
               @endforeach

            </div>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>
    @endsection
