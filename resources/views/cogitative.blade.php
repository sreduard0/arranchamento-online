@extends('layout')
@section('title', 'Cogitativo por companhia')
@section('cogitative', 'active')
@section('cogitative_open', 'menu-open')

@section('title-header', 'Cogitativo por companhia')
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
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Militar</th>
                            <th>Café</th>
                            <th>Almoço</th>
                            <th>Janta</th>
                            <th>Ações</th>
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
                    <h5 class="modal-title" id="registerLabel">Cadastrar empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-enterprise">
                        <div class="row">

                            <div class="form-group col">
                                <label>Empresa</label>
                                <input type="text" class="form-control" name="enterprise" id="enterprise"
                                    placeholder="Nome da empresa">
                            </div>

                            <div class="col-md-3 form-group ">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="phone" name="phone" placeholder="Telefone" value="">
                            </div>
                        </div>
                        <hr>
                        <label class="fs-23">Endereço</label>
                        <div class="row">
                            <div class="form-group col">
                                <label for="street">Logradouro</label>
                                <input type="text" class="form-control" id="street" name="street" placeholder="Logradouro"
                                    value="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="house_number">Nº</label>
                                <input type="text" class="form-control" id="number" name="number" placeholder="Nº">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="district">Bairro</label>
                                <input type="text" id="district" name="district" class="form-control"
                                    placeholder="Bairro">
                            </div>
                            <div class="form-group col">
                                <label for="city">Cidade</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Cidade">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="return add_enterprise()">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>



    {{-- Editar Empresa --}}
    <div class="modal fade" id="enterprise_edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enterprise_editLabel">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="id" name="id" value="">
                        <div class="form-group col">
                            <label for="newName">Nome</label>
                            <input type="text" class="form-control" id="newName" name="newName" value="">
                        </div>
                        <div class="form-group col">
                            <label for="newPhone">Telefone</label>
                            <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                inputmode="text" data-mask="" id="newPhone" name="newPhone" placeholder="Telefone" value="">
                        </div>
                        <div class="form-group col">
                            <label for="newAddress">Endereço</label>
                            <input type="text" class="form-control" id="newAddress" name="newAddress" value="">
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button onclick="return edit_enterprise()" class="btn btn-success">Atualizar</button>

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
                    "url": "{{ route('get_company_cogitative') }}",
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
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                dropdownParent: $("#register")
            });
            $('[data-mask]').inputmask()
        })
    </script>
@endsection
