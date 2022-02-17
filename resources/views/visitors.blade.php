@extends('layout')
@section('title', 'Visitantes')
@section('register_open', 'menu-open')
@section('register', 'active')
@section('visitors', 'active')
@section('title-header', 'Visitantes')
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
                <button class="float-r btn btn-success" data-toggle="modal" data-target="#register">Novo
                    visitante</button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="15">#</th>
                            <th>Nome</th>
                            <th>Contato</th>
                            <th width="40">CNH</th>
                            <th width="70">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
@endsection
@section('modal')

    <!-- Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerLabel">Cadastrar visitante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white"
                            style="background: url('{{ asset('img/bg-visitors.png') }}') center center;background-size:contain"
                            id="img_bg">
                            <div class="widget-user-image">
                                <img id="img_profile" class="img-circle" src="{{ asset('img/people.png') }}"
                                    alt="User Avatar">
                                <div class="panel-body">
                                    <label for="upload_image" class="btn btn-success edit-img-profile"><i
                                            class="fa fa-pen"></i></label>
                                    <input type="file" class="btn btn-success input-img-profile" name="upload_image"
                                        id="upload_image" accept="image/png,image/jpg,image/jpeg" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <form id="form-visitor">
                        <div class="row">
                            <input type="hidden" id="image_profile" name="image_profile" value="">
                            <div class="form-group col">
                                <label for="name_visitor">Nome completo</label>
                                <input id="name_visitor" name="name_visitor" type="text" class="form-control"
                                    placeholder="Nome do visitante">
                            </div>
                            <div class="col-md-3 form-group ">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['999.999.999-99']"
                                    inputmode="text" data-mask="" id="cpf" name="cpf" placeholder="CPF" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group ">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="phone" name="phone" placeholder="Telefone" value="">
                            </div>
                            <div class="form-group col">
                                <label for="cnh">CNH</label>
                                <select id="cnh" name="cnh" class="form-control" style="width: 100%;">
                                    <option value="0" selected="selected">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="enterprise_id">Empresa:</label>
                                <select id="enterprise_id" name="enterprise_id" class="select2" style="width: 100%;">
                                    <option disabled selected="selected">Selecione uma empresa</option>
                                    @foreach ($enterprises as $enterprise)
                                        <option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="return add_visitor()">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de envio de imagem --}}
    <div id="uploadimage" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ajustar imagem</h4>
                </div>
                <div class="modal-body">
                    <div id="image_demo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-success crop_image">Enviar</button>
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
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>


    <script>
        $(function() {
            $("#table").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "url": "{{ asset('plugins/datatables/Portuguese3.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('get_visitors') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },

                },
            });
        });
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                dropdownParent: $("#register")
            });

            $('[data-mask]').inputmask()

        })
    </script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endsection
