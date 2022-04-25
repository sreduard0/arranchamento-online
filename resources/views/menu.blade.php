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
                            <th>Almoço</th>
                            <th>Janta</th>
                            @if (session('Arranchamento')['profileType'] == 1)
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
                        <h5 class="modal-title" id="menuLabel">Novo cardápio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="form-menu">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data:</label>
                                        <div class="input-group date" id="date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                                value="" name="date" />
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
                                    <label for="brekker">Café</label>
                                    <textarea value="" class="form-control new_menu" name="brekker" id="brekker" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="lunch">Almoço</label>
                                    <textarea value="" class="form-control new_menu" name="lunch" id="lunch" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="dinner">Janta</label>
                                    <textarea value="" class="form-control new_menu" name="dinner" id="dinner" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success" onclick=" return new_menu()">Adicionar</button>
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
    </script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
