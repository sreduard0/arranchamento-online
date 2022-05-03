@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('script')
    <script src="{{ asset('js/croppie.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}" />
@endsection
{{-- Perfil usuario --}}
<div class="modal fade" id="visitor_profile" tabindex="-1" role="dialog" aria-labelledby="visitor_profile"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visitor_profileLabel">Perfil do visitante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white"
                                style="background: url('{{ asset('img/bg-visitors.png') }}') center center;background-size:100%">
                            </div>
                            <div class="widget-user-image">
                                <img id="edit_img" class="img-circle" src="{{ asset('img/people.png') }}"
                                    alt="User Avatar">
                                <div class="panel-body">
                                    <label for="upload_new_image" class="btn btn-success edit-img-profile"><i
                                            class="fa fa-pen"></i></label>
                                    <input type="file" class="btn btn-success input-img-profile" name="upload_new_image"
                                        id="upload_new_image" accept="image/png,image/jpg,image/jpeg" />
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="description-block">
                                    <h3 id="visitor_name" class="widget-user-desc text-center">
                                        Nome</h3>
                                    <h4 id="enterprise_name" class="widget-user-username text-center text-muted">
                                        Empresa </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background "> <i
                                                    class="fas fa-user mr-1"></i>
                                                Informações pessoais</h3>

                                            @if (session('PARPS')['profileType'] == 1)
                                                <button class="btn btn-default float-r" data-toggle="modal"
                                                    data-target="#edit_info_visitor"><i
                                                        class="fa fa-pen"></i></button>
                                            @endif

                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <input type="hidden" id="v_id" value="">
                                                <input type="hidden" id="enterprise_id" value="">
                                                <div class="  float-l col-md-6">
                                                    <strong> Nome completo</strong>

                                                    <p id="fullname" class="text-muted"></p>

                                                    <hr>

                                                    <strong>CNH</strong>

                                                    <p id="cnh" class="text-muted"></p>

                                                </div>
                                                <div class=" float-r col-md-6">
                                                    <strong>CPF</strong>

                                                    <p id="cpf" class="text-muted"></p>

                                                    <hr>

                                                    <strong>Contato</strong>

                                                    <p id="phone_visitor" class="text-muted"></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background "> <i
                                                    class="fas fa-user mr-1"></i>
                                                Empresa</h3>
                                            <button class="btn btn-default float-r" onclick="return editenterprise()"><i
                                                    class="fa fa-pen"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="  float-l col-md-6">

                                                    <strong> Nome</strong>

                                                    <p id="enterprise" class="text-muted"></p>
                                                    <hr>
                                                    <strong>Contato</strong>

                                                    <p id="enterprise_phone" class="text-muted"></p>


                                                </div>
                                                <div class=" float-r col-md-6">
                                                    <strong>Endereço</strong>

                                                    <p id="enterprise_address" class="text-muted"></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal de envio de imagem --}}
<div id="uploanewdimage" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajustar imagem</h4>
            </div>
            <div class="modal-body">
                <div id="image_prev"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button class="btn btn-success crop_new_image">Enviar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal INFO VISITOR -->
@if (session('PARPS')['profileType'] == 1)
    <div class="modal fade" id="edit_info_visitor" tabindex="-1" role="dialog"
        aria-labelledby="edit_info_visitorLabel" aria-hidden="true">
        <div class="modal-dialog modal-small modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_info_visitorLabel">Editar informações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-visitor">
                        <div class="row">
                            <div class="form-group col">
                                <label for="edit_name_visitor">Nome completo</label>
                                <input id="edit_name_visitor" name="edit_name_visitor" type="text"
                                    class="form-control" placeholder="Nome do visitante">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="edit_cnh">CNH</label>
                                <select id="edit_cnh" name="edit_cnh" class="form-control">
                                    <option value="1">Sim</option>
                                    <option selected value="0">Não</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col form-group ">
                                <label for="edit_cpf">CPF</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['999.999.999-99']"
                                    inputmode="text" data-mask="" id="edit_cpf" name="edit_cpf" placeholder="CPF"
                                    value="">
                            </div>
                            <div class="col form-group ">
                                <label for="edit_phone">Telefone</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="edit_phone" name="edit_phone"
                                    placeholder="Telefone" value="">
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="return edit_info_visitor()">Alterar</button>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- SCRIPTS --}}
<script>
    $('#visitor_profile').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        if (id == undefined) {
            id = $('#v_id').val();
        }

        var modal = $(this);
        var url = '/get_profile/' + id;
        $.get(url, function(result) {
            modal.find('#edit_img').attr("src", result.photo)
            modal.find('#visitor_name').text(result.name)
            modal.find('#enterprise_name').text(result.enterprise.name)
            modal.find('#fullname').text(result.name)
            modal.find('#cpf').text(result.cpf)
            modal.find('#phone_visitor').text(result.phone)
            modal.find('#enterprise_address').text(result.enterprise.address)
            modal.find('#enterprise_phone').text(result.enterprise.phone)
            $(this).find('#enterprise').text(result.enterprise.name)
            document.getElementById("v_id").value = id
            document.getElementById("enterprise_id").value = result.enterprise.id
            if (result.cnh == 1) {
                modal.find('#cnh').text('Este motorista tem CNH')
            } else {
                modal.find('#cnh').text('Este motorista não tem CNH')
            }
        })
    });
</script>
@if (session('PARPS')['profileType'] == 1)
    <script>
        $('#edit_info_visitor').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = $('#v_id').val();
            $('#visitor_profile').modal('hide');
            var modal = $(this);
            var url = '/get_profile/' + id;
            $.get(url, function(result) {
                modal.find('#edit_name_visitor').val(result.name)
                modal.find('#edit_cpf').val(result.cpf)
                modal.find('#edit_phone').val(result.phone)
                if (result.cnh == 1) {
                    $('#edit_cnh').val("1");
                } else {
                    $('#edit_cnh').val("0");
                }
            })
        });

        function edit_info_visitor() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });


            var data = {
                id: $('#v_id').val(),
                name: edit_name_visitor.value,
                cpf: edit_cpf.value,
                phone: edit_phone.value,
                cnh: edit_cnh.value,
            };


            if (
                data.cpf == "" ||
                data.phone == "" ||
                data.cnh == "" ||
                data.name == ""
            ) {

                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
                });

                return false;
            }

            if (data.cpf.replace(/\D+/g, "").length < 11) {
                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp Número de CPF incorreto.'
                });
                return false;
            }

            if (data.phone.replace(/\D+/g, "").length < 11) {
                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp Número de telefone incorreto.'
                });
                return false;
            }



            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/visitor/edit',
                type: 'POST',
                data: data,
                dataType: 'text',
                success: function(data) {

                    if (data == "error") {

                        Toast.fire({
                            icon: 'error',
                            title: '&nbsp&nbsp Esse CPF já está cadastrado.'
                        });
                    } else {

                        $("#edit_info_visitor").modal('hide');
                        $("#visitor_profile").modal('show');
                        $("#table").DataTable().clear().draw(6);
                        Toast.fire({
                            icon: 'success',
                            title: '&nbsp&nbsp Alterado com sucesso.'
                        });
                    }

                },

                error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
                }
            });
        }
    </script>
@endif


<script>
    function editenterprise() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });

        var url = '/enterprises_json';
        var enterprise_id = $('#enterprise_id').val();
        $('#visitor_profile').modal('hide');
        $.get(url, function(result) {
            bootbox.prompt({
                title: "Selecione a empresa.",
                inputType: 'select',
                centerVertical: true,
                value: enterprise_id,
                buttons: {
                    confirm: {
                        label: 'Editar',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'cancelar',
                        className: 'btn-secondary'
                    }
                },
                inputOptions: result,
                callback: function(result) {
                    if (result) {
                        var data = {
                            id: $('#v_id').val(),
                            enterprise_id: result
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/edit_enterprise_visitor',
                            type: 'POST',
                            data: data,
                            dataType: 'text',
                            success: function(data) {
                                $("#table").DataTable().clear().draw(6);
                                Toast.fire({
                                    icon: 'success',
                                    title: '&nbsp&nbsp Empresa alterad com sucesso.'
                                });
                                $('#visitor_profile').modal('show');
                            },

                            error: function(data) {
                                Toast.fire({
                                    icon: 'error',
                                    title: '&nbsp&nbsp Erro ao alterar.'
                                });
                            }
                        });
                    }

                }
            });

        })
    }
</script>
<script src="{{ asset('js/crop-img-profile.js') }}"></script>
