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
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
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
                <img src="{{ asset('img/iconaprov.png') }}" alt="PARPS" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Arranchamento</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="http://sistao.3bsup.eb.mil.br/{{ session('user')['photo'] }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="http://sistao.3bsup.eb.mil.br/profile/view"
                            class="d-block">{{ session('user')['rank'] }}
                            {{ session('user')['professionalName'] }}</a>
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
                        @switch(session('Arranchamento')['profileType'])
                            @case(1)
                                <li class="nav-item @yield('cogitative_open')">
                                    <a href="#" class="nav-link @yield('cogitative')">
                                        <i class="nav-icon fas fa-chart-bar"></i>
                                        <p>
                                            Cogitativo
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item  ">
                                            <a href="{{ route('cogitative_company', ['company' => 2]) }}"
                                                class="nav-link @if (!empty($company) && $company == 2) active @endif">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>CCSv</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('cogitative_company', ['company' => 3]) }}"
                                                class="nav-link  @if (!empty($company) && $company == 3) active @endif">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>1ª Cia</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('cogitative_company', ['company' => 4]) }}"
                                                class="nav-link  @if (!empty($company) && $company == 4) active @endif">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>2ª Cia</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('cogitative_company', ['company' => 5]) }}"
                                                class="nav-link  @if (!empty($company) && $company == 5) active @endif">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>3ª Cia</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('cogitative_company', ['company' => 1]) }}"
                                                class="nav-link  @if (!empty($company) && $company == 1) active @endif">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>EM</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @break

                            @case(0)
                                <li class="nav-item ">
                                    <a href="{{ route('history') }}" class="nav-link @yield('history') ">
                                        <i class="nav-icon fas fa-history"></i>
                                        <p>
                                            Histórico
                                        </p>
                                    </a>
                                </li>
                            @break
                        @endswitch
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
                            @if (session('Arranchamento')['profileType'] == 1)
                                <div class="small-box bg-primary">
                                    <div style='min-height: 150px' class="inner">
                                        <strong>
                                            <h2>Cogitativo total do dia</h2>
                                        </strong>
                                        <div class="fs-20" id='c_day'></div>
                                    </div>
                                    <div class="icon">
                                        <i class="mt-2 icon ion-md-restaurant"></i>
                                    </div>
                                </div>
                            @else
                                <div class="small-box bg-primary">
                                    <div style='min-height: 150px' class="inner">
                                        <strong>
                                            <h2 id="hour"></h2>
                                        </strong>
                                        <div id='menu_day'></div>
                                        <br>
                                        <div id='displacement'></div>
                                    </div>
                                    <div class="icon">
                                        <i class="mt-2 icon ion-md-restaurant"></i>
                                    </div>
                                    <a href="{{ route('menu') }}" class="btn btn-small btn-primary">Ver mais</a>
                                </div>
                            @endif

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
    @if (session('Arranchamento')['profileType'] == 1)
        <script>
            setTimeout(function() {
                var url = '/get_cogitative_day';
                $.get(url, function(result) {
                    document.getElementById('c_day').innerHTML = '<strong >Café:</strong>  ' + result
                        .total['brekker'] +
                        '<br> <strong>Almoço:</strong>  ' + result.total['lunch'] +
                        '<br> <strong>Janta:</strong>  ' + result.total['dinner'];
                })
            }, 1000);
        </script>
    @else
        <script>
            function getHour() {
                var currentTime = new Date();
                return (currentTime.getHours());
            }
            $(function() {
                var hour = getHour();

                if (hour > 05 && hour < 11) {
                    $.get('menu_day', function(result) {
                        document.getElementById('hour').innerText = 'Cardápio do café';
                        document.getElementById('menu_day').innerHTML = result.brekker;
                    })
                } else if (hour >= 11 && hour < 14) {

                    $.get('menu_day', function(result) {
                        document.getElementById('hour').innerText = 'Cardápio do almoço';
                        document.getElementById('menu_day').innerHTML = result.lunch;
                        document.getElementById('displacement').innerHTML =
                            'Horário de deslocamento da sua CIA:<br> <strong class="fs-20">' + result
                            .displacement + '</strong>';

                    })
                } else {
                    $.get('menu_day', function(result) {
                        document.getElementById('hour').innerText = 'Cardápio da janta';
                        document.getElementById('menu_day').innerHTML = result.dinner;
                    })
                }

            });
        </script>
    @endif
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
