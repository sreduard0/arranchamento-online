@extends('layout')
@section('title', 'Cogitativo')
@section('cogitative', 'active')
@section('cogitative_open', 'menu-open')

@section('title-header', 'Cogitativo')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('script')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
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
                <div id="form" class="row">
                    <div class="col-md-2">
                        <label>Data</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="date" class="form-control datetimepicker-input" data-target="#date"
                                name="date" value='{{ date('d-m-Y') }}' />
                            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <button onclick="return search_cogitative()" style="height: 40px;" class="btn btn-success m-t-30"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="300">Militar</th>
                            <th width="200">Café</th>
                            <th width="200">Almoço</th>
                            <th width="200">Janta</th>
                            <th width="90">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
@section('modal')
    <!-- Modal ediar arranchamento-->
    <div class="modal fade" id="admineditarranchamento" tabindex="-1" role="dialog"
        aria-labelledby="admineditarranchamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="admineditarranchamentoLabel">Editar arranchamento</h5>
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
                                <input class="form-control" value="" id="military" name="military" disabled
                                    style="width: 100%;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="company">CIA</label>
                                <input class="form-control" id="company" value="" disabled style="width: 100%;">
                            </div>

                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label>Data</label>
                                    <div class="input-group" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" value="" id="edate"
                                            disabled />
                                        <div class="input-group-append">
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
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <script src="{{ asset('js/inputmask.js') }}"></script>

    <script>
        $(function() {
            $("#table").DataTable({
                "paging": true,
                "processing": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "url": "{{ asset('plugins/datatables/Portuguese3.json') }}"
                },
                "dom": 'Bfrtip',
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('get_cogitative_company') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                },
                "ordering": false,
                "buttons": ["excel", "pdf", "print"]
            });
        });
        setTimeout(function() {
            $("#table_filter").remove();
        }, 500);

        $('#admineditarranchamento').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var modal = $(this)
            var url = '/get_edit_arranchamento/' + id;
            $('#form-editarranchar')[0].reset();
            $.get(url, function(result) {
                modal.find('.modal-title').text('Editar arranchamento')
                modal.find('#id').val(result.id)
                modal.find('#military').val(result.military.rank.rankAbbreviation + " " + result.military
                    .professionalName)
                switch (result.military.company_id) {
                    case 1:
                        var company = 'EM';
                        break;
                    case 2:
                        var company = 'CCSv';
                        break;
                    case 3:
                        var company = '1ª Cia';
                        break;
                    case 4:
                        var company = '2ª Cia';
                        break;
                    case 5:
                        var company = '3ª Cia';
                        break;

                }
                modal.find('#company').val(company)
                modal.find('#edate').val(moment(result.date).format('DD-MM-YYYY'))
                if (result.brekker == 1) {
                    $("#ebrekker").prop("checked", true);
                }
                if (result.lunch == 1) {
                    $("#elunch").prop("checked", true);
                }
                if (result.dinner == 1) {
                    $("#edinner").prop("checked", true);
                }

            })
        });
    </script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
