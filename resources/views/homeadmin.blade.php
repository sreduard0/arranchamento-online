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
        <div class="row">
            <div class="col col-3">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="ccsv">Carregando</h3>

                        <h5>CCSv</h5>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col col-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="1cia">Carregando</h3>
                        <h5>1ª Cia</h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col col-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="2cia">Carregando</h3>
                        <h5>2ª Cia</h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col col-3">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="3cia">Carregando</h3>
                        <h5>3ª Cia</h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col col-3">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="em">Carregando</h3>
                        <h5>EM</h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
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
                                Cogitativo dos próximos dias
                            </h3>
                        </div>
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="150">Dia</th>
                                    <th>CCSv</th>
                                    <th>1ª Cia</th>
                                    <th>2ª Cia</th>
                                    <th>3ª Cia</th>
                                </tr>
                            </thead>
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
        $(function() {
            $("#table").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": '<"top">rt<"bottom"ip><"clear">',
                "language": {
                    "url": "{{ asset('plugins/datatables/Portuguese2.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "get_arranchamentos",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },

                }
            });
        });
    </script>
    <script>

    </script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
