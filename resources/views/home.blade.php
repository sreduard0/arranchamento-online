@extends('layout')
@section('title', 'Início')
@section('home', 'active')
@section('title-header', 'Meus arranchamentos')
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
    @php
    $i = 1;
    @endphp
    <section class="col ">
        <div class="card">
            <div class="card-header">
                <button class="float-r btn btn-success" data-toggle="modal" data-target="#register">Novo
                    arranchamento</button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="20px">#</th>
                            <th>Data</th>
                            <th>Café</th>
                            <th>Almoço</th>
                            <th>Janta</th>
                            <th>Ceia</th>
                            <th>Registrado por</th>
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
    <!-- Modal  registro de visitante-->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerLabel">Novo arranchamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-register">
                        <div class="row">
                            <div class="form-group col">
                                <label for="reason">Militar</label>
                                <input class="form-control" value="Cb Eduardo" id="reason" name="reason" disabled
                                    style="width: 100%;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="reason">CIA</label>
                                <input class="form-control" value="CCSv" id="reason" name="reason" disabled
                                    style="width: 100%;">
                            </div>
                            <div class="form-group col-md-3">
                                {{-- <div class="form-group">
                                    <label>Date:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="form-group">
                                    <label>Data</label>

                                    <div class="input-group">
                                        <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                            <i class="far fa-calendar-alt"></i>
                                            <i class="fas fa-caret-down"></i>
                                        </button>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="row">
                            <div class="custom-control custom-checkbox m-l-8 m-r-30">
                                <input class="custom-control-input" type="checkbox" id="pspecial1" name='coffe' value="1">
                                <label for="pspecial1" class="custom-control-label">Café </label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="pspecial3" name='armoço' value="0">
                                <label for="pspecial3" class="custom-control-label">Almoço</label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="pspecial2" name='papa' value="2">
                                <label for="pspecial2" class="custom-control-label">Janta</label>
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick=" return register()">Arranchar-se</button>
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
        // $(function() {
        //     $("#table").DataTable({
        //         "paging": true,
        //         "responsive": true,
        //         "lengthChange": true,
        //         "autoWidth": false,
        //         "aoColumnDefs": [{
        //             'bSortable': false,
        //             'aTargets': [0, 1, 2, 3, 4, 5, 7]
        //         }],
        //         "dom": '<"top">rt<"bottom"ip><"clear">',
        //         "language": {
        //             "url": "{{ asset('plugins/datatables/Portuguese2.json') }}"
        //         },
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": {
        //             "url": "",
        //             "type": "POST",
        //             "headers": {
        //                 'X-CSRF-TOKEN': "{{ csrf_token() }}",
        //             },

        //         }
        //     });
        // });
    </script>

    <script>
        function formatText(icon) {
            return $('<span><i style="color:' + $(icon.element).data('color') + '" class="fas ' + $(icon.element).data(
                'icon') + '"></i> ' + icon.text + '</span>');
        };

        $('.select2').select2({
            dropdownParent: $("#register"),
            templateSelection: formatText,
            templateResult: formatText
        });

        function matchCustom(params, data) {

            document.querySelector(".select2-search__field").placeholder = "Buscar por NOME ou CPF";

            // Se não houver termos de pesquisa, retorne todos os dados
            if ($.trim(params.term) === '') {

                return data;
            }
            // `params.term` deve ser o termo usado para pesquisar
            // `data.text` é o texto que é exibido para o objeto de dados
            //pesquisa por cpf
            if (data.title.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true)

                // Você pode retornar objetos modificados a partir daqui
                // Isso inclui combinar os `filhos` como você quiser em conjuntos de dados aninhados
                return modifiedData;
            }

            //Pesquisa por nome
            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {

                console.log(data.text)
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (CPF:' + data.title + ')';

                // Você pode retornar objetos modificados a partir daqui
                // Isso inclui combinar os `filhos` como você quiser em conjuntos de dados aninhados
                return modifiedData;
            }
            // // Retorna `nulo` se o termo não deve ser exibido
            return null;
        }

        //Initialize Select2 Elements
        $('.select2s').select2({
            dropdownParent: $("#register"),
            matcher: matchCustom,
        });
    </script>
    <script src="{{ asset('js/actions.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
