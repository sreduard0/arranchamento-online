@extends('layout')
@section('title', 'Cardápio')
@section('menu', 'active')
@section('title-header', 'Cardápio do dia')
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
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <section class="col ">
        <div class="card">
            @if (session('Arranchamento')['profileType'] == 1)
                <div class="card-header">
                    <button class="float-r btn btn-success" data-toggle="modal" data-target="#menu">Novo cardápio</button>
                </div>
            @endif
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="150">Dia</th>
                            <th>Café</th>
                            <th>Almoço/Janta</th>
                            <th>Ceia</th>
                            <th width="150">Deslocamento</th>
                            @if (session('Arranchamento')['profileType'] == 1)
                                <th width="120">Criado/Alterado</th>
                                <th width="80">Ações</th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
@section('modal')
    @if (session('Arranchamento')['profileType'] == 1)
        <div class="modal fade" id="menu" tabindex="-1" role="dialog" aria-labelledby="menuLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="menuLabel">Cardápio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="form-menu">
                            <input type="hidden" name="id_edit" id="id_edit" value="">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data:</label>
                                        <div class="input-group date" id="date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                                value="" id="date_" name="date" />
                                            <div class="input-group-append" data-target="#date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Horário de deslocamento ao rancho</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Horário CCSv:</label>
                                    <div class="input-group time" id="h_ccsv" data-target-input="nearest">
                                        <input id="h_ccsv_" name="h_ccsv" type="text"
                                            class="form-control datetimepicker-input" data-target="#h_ccsv" value="">
                                        <div class="input-group-append time" data-target="#h_ccsv"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text time"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Horário 1ª Cia:</label>
                                    <div class="input-group time " id="h_cia1" data-target-input="nearest">
                                        <input name="h_cia1" id="h_cia1_" type="text"
                                            class="form-control datetimepicker-input" data-target="#h_cia1" value="">
                                        <div class="input-group-append time" data-target="#h_cia1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Horário 2ª Cia:</label>
                                    <div class="input-group time" id="h_cia2" data-target-input="nearest">
                                        <input name="h_cia2" id="h_cia2_" type="text"
                                            class="form-control datetimepicker-input" data-target="#h_cia2">
                                        <div class="input-group-append time" data-target="#h_cia2"
                                            data-toggle="datetimepicker" value="">
                                            <div class="input-group-text time"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Horário 3ª Cia:</label>
                                    <div class="input-group  time" id="h_cia3" data-target-input="nearest">
                                        <input name="h_cia3" id="h_cia3_" type="text"
                                            class="form-control datetimepicker-input" data-target="#h_cia3" value="">
                                        <div class="input-group-append" data-target="#h_cia3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="brekker">Café</label>
                                    <textarea class="form-control new_menu menu_brekker" name="brekker" id="brekker" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="lunch">Almoço/Janta</label>
                                    <textarea class="form-control new_menu menu_lunch" name="lunch" id="lunch" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="dinner">Ceia</label>
                                    <textarea class="form-control new_menu menu_dinner" name="dinner" id="dinner" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success" onclick=" return new_menu()">Concluir</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    {{-- especificos --}}
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <script src="{{ asset('js/inputmask.js') }}"></script>
    <script>
        $(function() {
            $("#table").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0, 2, 3]
                }],
                "dom": '<"top">rt<"bottom"ip><"clear">',
                "language": {
                    "url": "{{ asset('plugins/datatables/Portuguese4.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('get_menu') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },

                }
            });
            // Summernote
            $('.new_menu').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font'],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });

        });
        $('#menu').on('hide.bs.modal', function(event) {
            $('#form-menu')[0].reset();
            $(".menu_brekker").summernote('code', '');
            $(".menu_lunch").summernote('code', '');
            $(".menu_dinner").summernote('code', '');
        });
    </script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
