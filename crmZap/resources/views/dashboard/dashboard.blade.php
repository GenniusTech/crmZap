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
                        <h6 class="mb-0"></h6>
                        <p class="mb-2">Conversas em andamento</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-leads rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-comment-slash fa-3x"></i>
                    <div class="ms-3">
                        <h6 class="mb-0">70</h6>
                        <p class="mb-2">Conversas Finalizadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h5 class="mb-4">Atendentes</h5>
                <a href="#" class="link-atendente">Ir para atendentes<i class="fa fa-arrow-right ps-1"></i></a>
            </div>
            <div class="owl-carousel atendente-carousel">
                <div class="atendente-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">Cristina</h5>
                    <p class="mb-0">
                        <i class="fa fa-star"></i>
                        21 conversas em andamento
                    </p>
                </div>
                <div class="atendente-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">philipe</h5>
                    <p class="mb-0">
                        <i class="fa fa-star"></i>
                        74 conversas em andamento
                    </p>
                </div>
                <div class="atendente-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">jorlan alves</h5>
                    <p class="mb-0">
                        <i class="fa fa-star"></i>
                        10 conversas em andamento
                    </p>
                </div>
                <div class="atendente-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">ana cardoso</h5>
                    <p class="mb-0">
                        <i class="fa fa-star"></i>
                        13 conversas em andamento
                    </p>
                </div>
                <div class="atendente-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">aline lavinder</h5>
                    <p class="mb-0">
                        <i class="fa fa-star"></i>
                        26 conversas em andamento
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h5 class="mb-4">Whatsapp</h5>
                <a href="#" class="link-atendente">Ir para Whatsapp<i class="fa fa-arrow-right ps-1"></i></a>
            </div>
            <div class="owl-carousel whatsapp-carousel">
                <div class="whatsapp-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">Limpa nome indenização</h5>
                    <p class="mb-0">
                        <i class="bi bi-phone"></i>
                        Conectado
                    </p>
                </div>
                <div class="whatsapp-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">Limpa nome indenização</h5>
                    <p class="mb-0">
                        <i class="bi bi-phone"></i>
                        Conectado
                    </p>
                </div>
                <div class="whatsapp-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">Limpa nome indenização</h5>
                    <p class="mb-0">
                        <i class="bi bi-phone"></i>
                        Conectado
                    </p>
                </div>
                <div class="whatsapp-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">Limpa nome indenização</h5>
                    <p class="mb-0">
                        <i class="bi bi-phone"></i>
                        Conectado
                    </p>
                </div>
                <div class="whatsapp-item text-center">
                    <i class="bi bi-person-circle"></i>
                    <h5 class="mb-1">Limpa nome indenização</h5>
                    <p class="mb-0">
                        <i class="bi bi-phone"></i>
                        Conectado
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endsection
