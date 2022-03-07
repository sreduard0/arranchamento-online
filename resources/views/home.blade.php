@extends('layout')
@section('title', 'Início')
@section('home', 'active')
@section('title-header', 'Controle de visitantes')
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
                @if (session('PARPS')['profileType'] == 1)
                    <button class="float-l btn btn-success" onclick='return finish_all()'>Finalizar
                        expediente</button>
                @endif
                <button class="float-r btn btn-success" data-toggle="modal" data-target="#register">Nova
                    entrada</button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="20px">#</th>
                            <th>Visitante</th>
                            <th>Empresa</th>
                            <th>Destino</th>
                            <th>Motivo</th>
                            <th width="15px">Crachá</th>
                            <th>Registrado por</th>
                            <th width="130px">Entrada</th>
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
                    <h5 class="modal-title" id="registerLabel">Nova entrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-register">
                        <div class="row">
                            <div class="form-group col">
                                <label for="visitor_id">Visitante</label>
                                <select id="visitor_id" name="visitor_id" class="select2s" style="width: 100%;">

                                    @foreach ($visitors as $visitor)
                                        <option title="{{ $visitor->cpf }}" value="{{ $visitor->id }}">
                                            {{ $visitor->name }}</option>
                                    @endforeach
                                    <option value="" disabled selected>Selecione um visitante</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="drive">Motorista</label>
                                <select id="drive" name="drive" class="form-control">
                                    <option value="1">Sim</option>
                                    <option selected value="0">Não</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefone (optional)</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="phone" name="phone" placeholder="Telefone" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Entrada</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ date('d/m/Y h:i') }}" disabled>
                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="destination_id">Destino:</label>
                                <select id="destination_id" name="destination" class="select2" style="width: 100%;">
                                    <option value="" disabled selected>Selecione um destino</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}" data-icon="fa-circle"
                                            data-color='{{ $destination->color }}'>
                                            {{ $destination->destination }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="reason">Motivo</label>
                                <input class="form-control" placeholder="Digite o motivo" id="reason" name="reason"
                                    style="width: 100%;">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="badge_id">Crachá</label>
                                <input class="form-control" placeholder="Digite o número do crachá" id="badge"
                                    name="badge" style="width: 100%;">
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick=" return register()">Registrar</button>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        $(function() {
            $("#table").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0, 1, 2, 3, 4, 5, 7]
                }],
                "dom": '<"top">rt<"bottom"ip><"clear">',
                "language": {
                    "url": "{{ asset('plugins/datatables/Portuguese2.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('get_records') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },

                }
            });
        });
    </script>
    <script src="{{ asset('js/calendar.js') }}"></script>
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
        $('[data-mask]').inputmask();
    </script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
