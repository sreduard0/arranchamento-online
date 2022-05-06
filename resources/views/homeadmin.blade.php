@extends('layout')
@section('title', 'Início')
@section('home', 'active')
@section('title-header', 'Arranchamento - 3° B Sup')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

@endsection

@section('content')
    <section class="col ">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Cogitativo do dia
            </h3>
        </div>

        <div class="row">
            <div class="col-md-2 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="ccsv"><i class="fas fa-spinner"></i></h3>

                        <h5>CCSv - Hoje - <span id='h_ccsv'></span></h5>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('cogitative_company', ['company' => 2]) }}" class="small-box-footer">Ver mais <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="1cia"><i class="fas fa-spinner"></i></h3>
                        <h5>1ª Cia - Hoje - <span id='h_cia1'></span> </h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('cogitative_company', ['company' => 3]) }}" class="small-box-footer">Ver mais <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="2cia"><i class="fas fa-spinner"></i></h3>
                        <h5>2ª Cia - Hoje - <span id='h_cia2'></span></h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('cogitative_company', ['company' => 4]) }}" class="small-box-footer">Ver mais <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-2 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="3cia"><i class="fas fa-spinner"></i></h3>
                        <h5>3ª Cia - Hoje - <span id='h_cia3'></span></h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('cogitative_company', ['company' => 5]) }}" class="small-box-footer">Ver mais <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-2 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="em"><i class="fas fa-spinner"></i></h3>
                        <h5>EM - Hoje</h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('cogitative_company', ['company' => 1]) }}" class="small-box-footer">Ver mais <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Cogitativo do próximo dia (pode alterar até {{ date('d/m/Y') }} 23:59)
                            </h3>
                        </div>
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="150">Refeição</th>
                                    <th>CCSv</th>
                                    <th>1ª Cia</th>
                                    <th>2ª Cia</th>
                                    <th>3ª Cia</th>
                                    <th>EM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Café</td>
                                    <td>{{ $ccsv['brekker'] }} </td>
                                    <td>{{ $cia1['brekker'] }}</td>
                                    <td>{{ $cia2['brekker'] }}</td>
                                    <td>{{ $cia3['brekker'] }}</td>
                                    <td>{{ $em['brekker'] }}</td>
                                </tr>
                                <tr>
                                    <td>Almoço</td>
                                    <td>{{ $ccsv['lunch'] }} </td>
                                    <td>{{ $cia1['lunch'] }}</td>
                                    <td>{{ $cia2['lunch'] }}</td>
                                    <td>{{ $cia3['lunch'] }}</td>
                                    <td>{{ $em['lunch'] }}</td>
                                </tr>
                                <tr>
                                    <td>Janta</td>
                                    <td>{{ $ccsv['dinner'] }} </td>
                                    <td>{{ $cia1['dinner'] }}</td>
                                    <td>{{ $cia2['dinner'] }}</td>
                                    <td>{{ $cia3['dinner'] }}</td>
                                    <td>{{ $em['dinner'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('plugins')

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/numeric-comma.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/inputmask.js') }}"></script>
    <script>
        //================================[BUSCANDO COGITATIVO DAS CIAs]================================//
        setTimeout(function() {
            var url = '/get_cogitative_day';
            $.get(url, function(result) {
                document.getElementById('ccsv').innerHTML = 'Café:  ' + result.ccsv['brekker'] +
                    '<br> Almoço:  ' + result.ccsv['lunch'] + '<br>Janta:  ' + result.ccsv['dinner'];
                document.getElementById('h_ccsv').innerHTML = result.ccsv['h_ccsv'];
                document.getElementById('1cia').innerHTML = 'Café:  ' + result.cia1['brekker'] +
                    '<br> Almoço:  ' + result.cia1['lunch'] + '<br>Janta:  ' + result.cia1['dinner'];
                document.getElementById('h_cia1').innerHTML = result.cia1['h_cia1'];
                document.getElementById('2cia').innerHTML = 'Café:  ' + result.cia2['brekker'] +
                    '<br> Almoço:  ' + result.cia2['lunch'] + '<br>Janta:  ' + result.cia2['dinner'];
                document.getElementById('h_cia2').innerHTML = result.cia2['h_cia2'];
                document.getElementById('3cia').innerHTML = 'Café:  ' + result.cia3['brekker'] +
                    '<br> Almoço:  ' + result.cia3['lunch'] + '<br>Janta:  ' + result.cia3['dinner'];
                document.getElementById('h_cia3').innerHTML = result.cia3['h_cia3'];
                document.getElementById('em').innerHTML = 'Café:  ' + result.em['brekker'] +
                    '<br> Almoço:  ' + result.em['lunch'] + '<br>Janta:  ' + result.em['dinner'];
            })
        }, 2000);
    </script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
