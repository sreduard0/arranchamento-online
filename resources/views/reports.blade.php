@extends('layout')
@section('title', 'Relatórios')
@section('reports', 'active')
@section('title-header', 'Relatório')
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            visibility: hidden;
        }

    </style>
@endsection
@section('content')


    <section class="col ">
        <div class="card">
            <div class="card-header">
                <div id="form" class="row">
                    <div class="col">
                        <label for="visitor_id">Visitante</label>
                        <select id="visitor_id" name="visitor_id" class="select2s" style="width: 100%;">
                            <option value="" selected="selected">Todos</option>
                            @foreach ($visitors as $visitor)
                                <option @if ($id_visitor == $visitor->id) selected @endif title="{{ $visitor->cpf }}"
                                    value="{{ $visitor->id }}">
                                    {{ $visitor->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col">
                        <label for="enterprise_id">Empresa</label>
                        <select id="enterprise_id" name="enterprise_id" class="select2" style="width: 100%;">
                            <option value="" selected="selected">Todas</option>
                            @foreach ($enterprises as $enterprise)
                                <option @if ($enterprise_id == $enterprise->id) selected @endif value="{{ $enterprise->id }}">
                                    {{ $enterprise->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col">
                        <label for="destination_id">Destino</label>
                        <select id="destination_id" name="destination_id" class="select2" style="width: 100%;">
                            <option value="" selected="selected">Todos</option>
                            @foreach ($destinations as $destination)
                                <option @if ($destination_id == $destination->id) selected @endif value="{{ $destination->id }}">
                                    {{ $destination->destination }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col">
                        <label>Data inícial:</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datefrom"
                                name="datefrom" id="datefrom" value='01-{{ date('m-Y') }} 08:00' />
                            <div class="input-group-append" data-target="#datefrom" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label>Data final:</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="dateto" class="form-control datetimepicker-input" data-target="#dateto"
                                name="dateto" value='{{ date('d-m-Y H:i:s') }}' />
                            <div class="input-group-append" data-target="#dateto" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <button onclick="return search_reports()" style="height: 40px;" class="btn btn-success m-t-30"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="card-body">

                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="20px">#</th>
                            <th>Visitante</th>
                            <th>Destino</th>
                            <th>Motivo</th>
                            <th>Registrado por</th>
                            <th>Finalizado por</th>
                            <th width="130px">Entrada</th>
                            <th width="130px">Saida</th>
                            <th width="40px">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    @include('visitor_profile')
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
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    {{-- ESPECIFICOS --}}

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
                    "url": "{{ route('get_reports') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                },
                "buttons": ["excel", "pdf", "print"]
            });

        });
    </script>
    <script>
        $('.select2').select2();

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
            matcher: matchCustom,
        });

        //Date and time picker
        $('#datefrom').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'DD-MM-YYYY HH:mm'
        });

        //Date and time picker
        $('#dateto').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'DD-MM-YYYY HH:mm'
        });
    </script>


@endsection
