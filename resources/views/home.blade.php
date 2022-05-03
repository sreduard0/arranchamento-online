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
        <div class="card">
            <div class="card-header">
                <button class="float-r btn btn-success" data-toggle="modal" data-target="#arrancharse">Arranchar-se</button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Café</th>
                            <th>Almoço</th>
                            <th>Janta</th>
                            <th width="80px">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
@endsection
@section('modal')
    <!-- Modal se arranchar-->
    <div class="modal fade" id="arrancharse" tabindex="-1" role="dialog" aria-labelledby="arrancharseLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="arrancharseLabel">Novo arranchamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-arranchar">
                        <div class="row">
                            <div class="form-group col">
                                <label for="military">Militar</label>
                                <input class="form-control"
                                    value="{{ session('user')['rank'] }} {{ session('user')['professionalName'] }}"
                                    id="military" name="military" disabled style="width: 100%;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="company">CIA</label>
                                <input class="form-control" value="{{ session('user')['company']['name'] }}" disabled
                                    style="width: 100%;">
                            </div>

                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label>Data:</label>
                                    <div class="input-group date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                            value="" name="date" />
                                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="custom-control custom-checkbox m-l-8 m-r-30">
                                <input class="custom-control-input" type="checkbox" id="brekker" name='brekker' value="1">
                                <label for="brekker" class="custom-control-label">Café </label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="lunch" name='lunch' value="1">
                                <label for="lunch" class="custom-control-label">Almoço</label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="dinner" name='dinner' value="1">
                                <label for="dinner" class="custom-control-label">Janta</label>
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick=" return arranchar()">Arranchar-se</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ediar arranchamento-->
    <div class="modal fade" id="editarranchamento" tabindex="-1" role="dialog" aria-labelledby="editarranchamentoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarranchamentoLabel">Editar arranchamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-editarranchar">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="form-group col">
                                <label for="military">Militar</label>
                                <input class="form-control"
                                    value="{{ session('user')['rank'] }} {{ session('user')['professionalName'] }}"
                                    id="military" name="military" disabled style="width: 100%;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="company">CIA</label>
                                <input class="form-control" value="{{ session('user')['company']['name'] }}" disabled
                                    style="width: 100%;">
                            </div>

                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label>Data:</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                            value="" name="date" id="edate" disabled />
                                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="custom-control custom-checkbox m-l-8 m-r-30">
                                <input class="custom-control-input" type="checkbox" id="ebrekker" name='ebrekker' value="1">
                                <label for="ebrekker" class="custom-control-label">Café </label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="elunch" name='elunch' value="1">
                                <label for="elunch" class="custom-control-label">Almoço</label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="edinner" name='edinner' value="1">
                                <label for="edinner" class="custom-control-label">Janta</label>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick=" return editarranchamento()">Alterar</button>
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('js/actions.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
