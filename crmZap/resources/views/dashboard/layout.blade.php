<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        
        <link href="{{ asset('dashboard/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet">

        <script src="{{ asset('dashboard/assets/js/jquery.js') }}"></script>

        <title>Grupo sollution - Admin</title>
    </head>

    <body>

        <header>
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="#" class="navbar-brand mx-4 mb-3">
                        <h3 class="logo">Grupo Sollution</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-3 user-text">
                            <h6 class="mb-0 user-name">{{  Auth::user()->nome}}</h6>
                            <span class="user-email">{{  Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="{{ Route('dashboard') }}" class="nav-item nav-link">
                            <i class="fa fa-th me-2"></i></i>
                         Dashboard
                        </a>
                        <a href="{{ Route('lead') }}" class="nav-item nav-link">
                            <i class="fa fa-users me-2"></i>
                            Leads
                        </a>

                        @if ($tipo === 1)
                        <a href="{{ Route('dep') }}" class="nav-item nav-link">
                            <i class="fa fa-briefcase me-2"></i>
                            Departamentos
                        </a>
                        @endif

                        @if ($tipo === 1)
                            <a href="{{ Route('atend') }}" class="nav-item nav-link">
                                <i class="fa fa-user-plus me-2"></i>
                                Atendente
                            </a>
                        @endif

                        @if ($tipo === 1)
                        <a href="{{ Route('avaliacao') }}" class="nav-item nav-link">
                            <i class="fa fa-chart-bar me-2"></i>
                            Avaliações
                        </a>
                        @endif

                        <a href="{{ Route('contato') }}" class="nav-item nav-link">
                            <i class="fa fa-address-book me-2"></i>
                            Contatos
                        </a>

                      

                        @if ($tipo === 1)
                        <a href="#" class="nav-item nav-link">
                            <i class="bi bi-gear-fill me-2"></i>
                            Configurações
                        </a>
                        @endif

                        <a href="{{ Route('perfil') }}" class="nav-item nav-link">
                            <i class="bi bi-person-circle me-2"></i>
                            Perfil
                        </a>
                        
                        <a href="{{ route('logout') }}" class="nav-item nav-link">
                            
                            Sair
                        </a>
                   
                    </div>
                </nav>
            </div>
        </header>

        <section>
            <div class="content">
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0">
                            <i class="fa fa-hashtag"></i>
                        </h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="d-none d-md-flex ms-4 pt-2">
                        <h4>Dashboard</h4>
                    </div>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="d-none d-lg-inline-flex">Suporte</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <span class="d-none d-lg-inline-flex">Sair</span>
                            </a>
                        </div>
                    </div>
                </nav>
                    @yield('conteudo')

                    <div class="container-fluid pt-4 px-4">
                        <div class="bg-light rounded-top p-4">
                            <div class="row">
                                <div class="col-12 col-sm-12 text-center">
                                    &copy;
                                    <a href="#">Grupo Sollution</a>
                                    , todos os direitos reservados.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('dashboard/assets/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/lib/tempusdominus/js/moment.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

    </body>

</html>