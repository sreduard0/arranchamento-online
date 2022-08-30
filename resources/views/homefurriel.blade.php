@extends('layout')
@section('title', 'Furriel')
@section('home', 'active')
@section('title-header', 'Arranchamento do furriel')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('script')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script>
        $(document).on('click', '#todos', function(e) {
            $('.check').each(function() {
                var checked = $(this).is(':checked');
                if (!$('#todos').is(':checked') && checked) {
                    $(this).prop('checked', false);
                    $(".sts").prop("disabled", true);

                } else if ($('#todos').is(':checked') && !checked) {
                    $(this).prop('checked', true);
                    $(".sts").prop("disabled", false);


                }
            });
        });

        $(document).on('click', '#todosdinner', function(e) {
            $('.dinner').each(function() {
                var checked = $(this).is(':checked');
                if (!$('#todosdinner').is(':checked') && checked) {
                    $(this).prop('checked', false);
                } else if ($('#todosdinner').is(':checked') && !checked) {
                    $(this).prop('checked', true);
                }
            });
        });
        $(document).on('click', '#todoslunch', function(e) {
            $('.lunch').each(function() {
                var checked = $(this).is(':checked');
                if (!$('#todoslunch').is(':checked') && checked) {
                    $(this).prop('checked', false);
                } else if ($('#todoslunch').is(':checked') && !checked) {
                    $(this).prop('checked', true);
                }
            });
        });
        $(document).on('click', '#todosbrekker', function(e) {
            $('.brekker').each(function() {
                var checked = $(this).is(':checked');
                if (!$('#todosbrekker').is(':checked') && checked) {
                    $(this).prop('checked', false);
                } else if ($('#todosbrekker').is(':checked') && !checked) {
                    $(this).prop('checked', true);
                }
            });
        });

        @foreach ($all_military as $military)
            $(function() {
                var check = $("#{{ $military->id }}"); //checkbox que ativara os restantes

                check.on('click', function() {
                    if (check.prop('checked') == true) {
                        $(".{{ $military->id }}_arranchado").prop("disabled",
                            false); //mostra os as permissoes

                    } else if (check.prop('checked') == false) {
                        $(".{{ $military->id }}_arranchado").prop("disabled",
                            true); //oculta os as permissoes
                    }
                })
            })
        @endforeach

        function arranchar_cia_furriel() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });

            var day_all = $('input[name=day_all]').val();
            var partsDate = day_all.split("-");
            var day = new Date(partsDate[2], partsDate[1] - 1, partsDate[0]);

            if (!moment(moment(day).format('YYYY-MM-DD')).isAfter(moment().format('YYYY-MM-DD'))) {

                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp Selecione uma data à partir de amanhã.'
                });

                return false;
            }
            @foreach ($all_military as $military)
                if ($('input[name=sts_{{ $military->id }}]').is(':checked')) {
                    var check{{ $military->id }} = 1;

                    if (!$('input[name={{ $military->id }}_brekker]').is(':checked') &&
                        !$('input[name={{ $military->id }}_lunch]').is(':checked') &&
                        !$('input[name={{ $military->id }}_dinner]').is(':checked')) {

                        Toast.fire({
                            icon: 'error',
                            title: "&nbsp&nbsp Selecione pelo menos uma refeição para {{ $military->professionalName }}"
                        });
                        return false;
                    }

                } else {
                    var check{{ $military->id }} = 0;
                }
            @endforeach

            var dados = {
                @foreach ($all_military as $military)
                    {{ $military->id }}: {
                        userID: {{ $military->id }},
                        date: $('input[name=day_all]').val(),
                        check: check{{ $military->id }},
                        company: {{ $military->company_id }},
                        brekker: $('input[name={{ $military->id }}_brekker]:checked').attr('value'),
                        lunch: $('input[name={{ $military->id }}_lunch]:checked').attr('value'),
                        dinner: $('input[name={{ $military->id }}_dinner]:checked').attr('value'),
                    },
                @endforeach
            };
            $("#loading").append(
                '<div id="loadingremove" class="load-block"><div class="c-loader"></div><span id="message" class="c-w">Arranchando acompanhia.</span><br><span id="message" class="c-w">Aguarde até que seja finalizado.</span></div>'
            );
            $("#arranchar_cia").modal('hide');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('arranchamento_cia') }}",
                type: "POST",
                data: dados,
                dataType: 'text',
                success: function(data) {
                    $("#loadingremove").detach();
                    $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Companhia arranchada com sucesso.'
                    });
                },
                error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao arranchar militares.'
                    });
                }
            });

        }
    </script>
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
            <div class="card-header row">
                <div class="col-md-3">
                    <label>Data</label>
                    <div class="input-group row date" data-target-input="nearest">
                        <input type="text" id="date" class="form-control datetimepicker-input" data-target="#date"
                            name="date" value='{{ date('d-m-Y') }}' />
                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button onclick="return search_cogitative()" style="height: 40px;" class="btn btn-success m-t-30"><i
                            class="fa fa-search"></i></button>
                </div>

                <div class="col">
                    <button class="m-t-30 m-l-10 float-r btn btn-primary" data-toggle="modal"
                        data-target="#arranchar_cia">Arranchar
                        companhia</button>

                    <button class="m-t-30 float-r btn btn-success" data-toggle="modal"
                        data-target="#arranchar_military">Arranchar
                        militar</button>
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
                                        <input type="text" class="form-control datetimepicker-input" value=""
                                            id="edate" disabled />
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="custom-control custom-checkbox m-l-8 m-r-30">
                                <input class="custom-control-input" type="checkbox" id="ebrekker" name='ebrekker'
                                    value="1">
                                <label for="ebrekker" class="custom-control-label">Café </label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="elunch" name='elunch'
                                    value="1">
                                <label for="elunch" class="custom-control-label">Almoço</label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="edinner" name='edinner'
                                    value="1">
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


    <!-- Modal arranchar militar-->
    <div class="modal fade" id="arranchar_military" tabindex="-1" role="dialog"
        aria-labelledby="arranchar_militaryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="arranchar_militaryLabel">Arranchar militar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-arranchar_military">
                        <div class="row">
                            <div class="form-group col">
                                <label for="military_id">Militar</label>
                                <select id="military_id" name="military_id" class="form-control select2"
                                    style="width: 100%;">
                                    @foreach ($all_military as $military)
                                        <option value="{{ $military->id }}">{{ $military->rank->rankAbbreviation }}
                                            {{ $military->professionalName }}</option>
                                    @endforeach
                                    <option value="" disabled selected>Selecione um militar</option>
                                </select>

                            </div>
                            <div class="form-group col-md-3">
                                <label>Data</label>
                                <div class="input-group date" id="day" data-target-input="nearest">
                                    <input id="day" name="day" type="text"
                                        class="form-control datetimepicker-input" data-target="#day" value="">
                                    <div class="input-group-append date" data-target="#day" data-toggle="datetimepicker">
                                        <div class="input-group-text date"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="custom-control custom-checkbox m-l-8 m-r-30">
                                <input class="custom-control-input" type="checkbox" id="brekker" name='brekker'
                                    value="1">
                                <label for="brekker" class="custom-control-label">Café </label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="lunch" name='lunch'
                                    value="1">
                                <label for="lunch" class="custom-control-label">Almoço</label>
                            </div>
                            <div class="custom-control custom-checkbox m-r-30">
                                <input class="custom-control-input" type="checkbox" id="dinner" name='dinner'
                                    value="1">
                                <label for="dinner" class="custom-control-label">Janta</label>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success"
                        onclick="return arranchar_furriel()">Arranchar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal arranchar cia-->
    <div class="modal fade" id="arranchar_cia" tabindex="-1" role="dialog" aria-labelledby="arranchar_ciaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="arranchar_ciaLabel">Arranchar {{ session('user')['company']['name'] }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class=" modal-body">
                    <form id="form-arranchar_cia">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Data</label>
                                <div class="input-group date" id="day_all_" data-target-input="nearest">
                                    <input id="day_all" name="day_all" type="text"
                                        class="form-control datetimepicker-input" data-target="#day_all_"
                                        value="{{ date('d-m-Y', strtotime('+1 days')) }}">
                                    <div class="input-group-append date" data-target="#day_all_"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text date"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-between m-b-30">
                            <div class="custom-control custom-switch checktodos ">
                                <input type="checkbox" class="custom-control-input" name="sts_todos" id='todos'
                                    value='1'>
                                <label class="custom-control-label" for='todos'>Todos militares da Cia
                                </label>
                            </div>
                            {{-- bloco de refeiçoes --}}
                            <div class="row">
                                <div class="custom-control custom-checkbox m-r-30">
                                    <input class="sts brekker custom-control-input" type="checkbox" id="todosbrekker"
                                        name='todosbrekker' value="1" disabled checked>
                                    <label for="todosbrekker" class="custom-control-label">Café</label>
                                </div>

                                <div class="custom-control custom-checkbox m-r-30">
                                    <input class="sts lunch custom-control-input" type="checkbox" id="todoslunch"
                                        name='todoslunch' value="1" disabled checked>
                                    <label for="todoslunch" class="custom-control-label">Almoço</label>
                                </div>
                                <div class="custom-control custom-checkbox m-r-30">
                                    <input class="sts dinner custom-control-input" type="checkbox" id="todosdinner"
                                        name='todosdinner' value="1" disabled>
                                    <label for="todosdinner" class="custom-control-label">Janta
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @foreach ($all_military as $military)
                            <div class="row justify-content-between m-b-30">
                                {{-- Ativar --}}
                                <div class="custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input check"
                                        name="sts_{{ $military->id }}" id={{ $military->id }} value='1'>
                                    <label class="custom-control-label"
                                        for={{ $military->id }}>{{ $military->rank->rankAbbreviation }}
                                        {{ $military->professionalName }}</label>
                                </div>

                                {{-- bloco de refeiçoes --}}
                                <div class="row">
                                    {{-- cafe --}}
                                    <div class="custom-control custom-checkbox m-r-30">
                                        <input class="{{ $military->id }}_arranchado sts brekker custom-control-input"
                                            type="checkbox" id="brekker-{{ $military->id }}"
                                            name='{{ $military->id }}_brekker' value="1" disabled checked>
                                        <label for="brekker-{{ $military->id }}"
                                            class="custom-control-label">Café</label>
                                    </div>
                                    {{-- permissao conv --}}
                                    <div class="custom-control custom-checkbox m-r-30">
                                        <input class="{{ $military->id }}_arranchado sts lunch custom-control-input"
                                            type="checkbox" id="lunch-{{ $military->id }}"
                                            name='{{ $military->id }}_lunch' value="1" disabled checked>
                                        <label for="lunch-{{ $military->id }}"
                                            class="custom-control-label">Almoço</label>
                                    </div>
                                    {{-- permissao especial --}}
                                    <div class="custom-control custom-checkbox m-r-30">
                                        <input class="{{ $military->id }}_arranchado sts dinner custom-control-input"
                                            type="checkbox" id="dinner-{{ $military->id }}"
                                            name='{{ $military->id }}_dinner' value="1" disabled>
                                        <label for="dinner-{{ $military->id }}" class="custom-control-label">Janta
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success"
                        onclick="return arranchar_cia_furriel()">Arranchar</button>
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
        $('.select2').select2({
            dropdownParent: $("#arranchar_military"),
        });
        $(function() {
            $("#table").DataTable({
                "paging": false,
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
                    "url": "{{ route('get_company_cogitative') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                },
                "buttons": [{
                    'extend': 'print',
                    'title': 'Arranchamento - {{ $company_name }}',
                    'messageTop': "<strong>{{ $name[0] }}<strong/> {{ $name[1] }} -  {{ session('user')['rank'] }}",
                    'messageBottom': '{{ $function }}',
                    'exportOptions': {
                        'columns': [0, 1, 2, 3],
                    },
                }, ]
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
