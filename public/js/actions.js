//================================[RESGISTRANDO ENTRADA]================================//
function register() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        visitor_id: visitor_id.value,
        drive: drive.value,
        phone: phone.value,
        destination_id: destination_id.value,
        reason: reason.value,
        badge: badge.value
    };

    if (
        data.visitor_id == "" ||
        data.drive == "" ||
        data.destination_id == "" ||
        data.reason == "" ||
        data.badge == ""
    ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

    if (data.phone.replace(/\D+/g, "").length > 1 && data.phone.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de telefone incorreto.'
        });
        return false;
    }



    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:'/record/visitor',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp O visitante não possui CNH ou já esta registrado.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Entrada registrada com sucesso.'
                });

                $('#form-register')[0].reset();
                $(".select2s").val('').trigger('change');
                $(".select2").val('').trigger('change');

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao registrar.'
                    });
        }
    });
}

//================================[RESGISTRANDO SAIDA]================================//
function confirm_exit(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja encerrar esta visita ?',
        message: '<strong>Essa operação não pode ser desfeita!</strong> <br> Lembre-se de recolher o cracha do visitante e verificar se o mesmo não esqueceu nada nas dependencias da OM.',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  location+"record/finish/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Visita encerrada com sucesso.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao encerrar visita'
                    });

                }
            });
        },
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-default'
            },
            confirm: {
                label: 'Encerrar',
                className: 'btn-success'
            }

        }
    });
}

//================================[ADICIONAR EMPRESA]================================//
function add_enterprise() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        enterprise: enterprise.value,
        phone: phone.value,
        street: street.value,
        number: number.value,
        district: district.value,
        city: city.value
    };


    if (
        data.enterprise == "" ||
        data.phone == "" ||
        data.street == "" ||
        data.number == "" ||
        data.district == "" ||
        data.city == ""
    ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

    if (data.phone.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de telefone incorreto.'
        });
        return false;
    }



    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/enterprise/add',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Essa empresa já está cadastrada.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Empresa cadastrada com sucesso.'
                });

                $('#form-enterprise')[0].reset();

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
        }
    });
}

//================================[DELETAR EMPRESA]================================//
function confirm_delete(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir essa empresa?',
        message: '<strong>Essa operação não pode ser desfeita!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  "/enterprise/delete/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Empresa excluida.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro excluir.'
                    });

                }
            });
        },
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-default'
            },
            confirm: {
                label: 'Excluir',
                className: 'btn-danger'
            }

        }
    });
}

//================================[EDITAR EMPRESA]================================//
function edit_enterprise() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        id: id.value,
        new_name: newName.value,
        new_phone: newPhone.value,
        new_address: newAddress.value,
    };


    if ( data.new_name == "" || data.new_phone == "" || data.new_address == ""  ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

    if (data.new_phone.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de telefone incorreto.'
        });
        return false;
    }




    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/enterprise/edit',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {
            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Uma empresa com este nome já está cadastrada.'
             });
            } else {

                $("#enterprise_edit").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Empresa alterada com sucesso.'
                });

                $('#form-enterprise')[0].reset();

            }
        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
        }
    });
}

//================================[ADICIONAR VISITANTE]================================//
function add_visitor() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        image_profile: image_profile.value,
        name: name_visitor.value,
        cpf: cpf.value,
        phone: phone.value,
        cnh: cnh.value,
        enterprise_id: enterprise_id.value,
    };


    if (
        data.image_profile == "" ||
        data.cpf == "" ||
        data.phone == "" ||
        data.cnh == "" ||
        data.enterprise_id == "" ||
        data.name == ""
    ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

       if (data.cpf.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de CPF incorreto.'
        });
        return false;
    }

    if (data.phone.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de telefone incorreto.'
        });
        return false;
    }



    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/visitor/add',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Esse(a) visitante já está cadastrada.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Visitante cadastrado(a) com sucesso.'
                });

                $('#form-visitor')[0].reset();
                $(".select2").val('').trigger('change');

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
        }
    });
}

//================================[DELETAR VISITANTE]================================//
function delete_visitor(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir esse(a) visitante?',
        message: '<strong>Essa operação não pode ser desfeita!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  "/visitor/delete/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Visitante excluido.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao excluir.'
                    });

                }
            });
        },
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-default'
            },
            confirm: {
                label: 'Excluir',
                className: 'btn-danger'
            }

        }
    });
}

//================================[ADICIONAR DESTINO]================================//
function add_destination() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        destination: destination.value,
        color: color.value,
    };


    if (
        data.destination == "" ||
        data.color == ""

    ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/destination/add',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Esse destino já existe.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Destino adicionado com sucesso.'
                });

                $('#form-destination')[0].reset();

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao adicionar.'
                    });
        }
    });
}

//================================[DELETAR DESTINO]================================//
function delete_destination(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir esse destino?',
        message: '<strong>Essa operação não pode ser desfeita!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  "/destination/delete/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Destino excluido.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro excluir.'
                    });

                }
            });
        },
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-default'
            },
            confirm: {
                label: 'Excluir',
                className: 'btn-danger'
            }

        }
    });
}

//================================[RESGISTRANDO FIM DE EXPEDIENTE]================================//
function finish_all(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja encerrar o expediente?',
        message: '<strong>Essa operação não pode ser desfeita!</strong> <br> Lembre-se de avisar a guarda que há civis nas dependências da OM.',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  '/finish_all',
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Expediente encerrado com sucesso.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao encerrar'
                    });

                }
            });
        },
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-default'
            },
            confirm: {
                label: 'Encerrar',
                className: 'btn-success'
            }

        }
    });
}

//================================[BUSCANDO RELATORIOS]================================//
function search_reports() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
       });

    var data = {
        visitor_id: visitor_id.value,
        enterprise_id: enterprise_id.value,
        destination_id: destination_id.value,
        datefrom: datefrom.value,
        dateto: dateto.value
    };

    $('#table').DataTable().column(1).search(data.visitor_id).column(2).search(data.enterprise_id).column(3).search(data.destination_id).column(6).search(data.datefrom).column(7).search(data.dateto).draw();

}
