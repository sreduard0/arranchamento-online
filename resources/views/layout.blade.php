<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>DEV ARRANCHAMENTO - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    {{-- ==================================== CSS/JS ===================================== --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css') }}">

    {{-- CSS ESPECIFICO --}}
    @yield('css')
    {{-- CSS ESPECIFICO --}}
    {{-- sweetalert2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <script type="text/javascript">
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            // adicione um zero na frente de números<10
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML = h + ":" + m;
            t = setTimeout('startTime()', 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>

    @yield('script')

    {{-- ====================================/ CSS/JS ===================================== --}}

</head>

<body onload="startTime()" class="dark-mode hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="" height="60" width="60">
        </div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="PARPS" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Arranchamento</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="http://sistao.3bsup.eb.mil.br/" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="http://sistao.3bsup.eb.mil.br/profile/view" class="d-block">CB Eduardo</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item ">
                            <a href="{{ route('home') }}" class="nav-link @yield('home')">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Início
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('menu') }}" class="nav-link @yield('menu')">
                                <i class="nav-icon fas fa-turkey"></i>
                                <p>
                                    Cardápio
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('history') }}" class="nav-link @yield('history') ">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Histórico
                                </p>
                            </a>
                        </li>



                        {{-- <li class="nav-item @yield('register_open')">
                            <a href="#" class="nav-link @yield('register')">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>
                                    Cardápio
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="" class="nav-link @yield('enterprise')">
                                        <i class="fa fa-building nav-icon"></i>
                                        <p>Empresa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link @yield('visitors')">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p>Visitantes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                         @if (session('PARPS')['profileType'] >= 1)
                            <li class="nav-item ">
                                <a href="{{ route('reports') }}" class="nav-link @yield('reports')">
                                    <i class="nav-icon fas fa-file-chart-pie"></i>
                                    <p>
                                        Relatórios
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item @yield('config_open')">
                                <a href="#" class="nav-link @yield('config')">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Configurações
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('destination') }}" class="nav-link @yield('destination')">
                                            <i class="fa fa-map-marker-alt nav-icon"></i>
                                            <p>Destinos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif --}}
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title-header')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        {{-- Conteudo --}}

                        @yield('content')

                        {{-- /CONTEUDO --}}
                        <section class="col-lg-3">
                            {{-- <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="here">0</h3>
                                    <p>Visitantes na OM</p>
                                </div>
                                <div class="icon">
                                    <i class="icon ion-md-people"></i>
                                </div>

                            </div> --}}
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 id="today">Cardápio do dia</h3>
                                    - teste <br>
                                    - teste<br>
                                    - teste<br>
                                    - teste
                                </div>
                                <div class="icon">
                                    <i class="icon ion-md-people"></i>
                                </div>

                            </div>


                            <div class="card bg-default">
                                <div class="card-header border-0 bg-success">

                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Calendário
                                    </h3>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pt-0">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="small-box bg-success">
                                <div class="inner text-center">
                                    <span style="font-size:60px"><b id="txt"></b></span>
                                    <p>Horário de brasília</p>
                                </div>
                            </div>

                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <footer class="main-footer align-items-center ">
            <footer>
                <div class="text-center">
                    &copy;ARRANCHAMENTO {{ date('Y') }} (v1) | integrado com &copy;SisTAO {{ date('Y') }}
                    (v1.5)
                    <br>
                    Desenvolvido por: Eduardo Martins
                </div>
            </footer>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    {{-- ========================== MODAL ========================== --}}
    @yield('modal')
    {{-- ==================================== PLUGINS ===================================== --}}
    <script src="{{ asset('js/calendar.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/locales.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.j') }}s"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    @yield('plugins')
    {{-- ====================================/ PLUGINS ===================================== --}}
</body>


</html>
