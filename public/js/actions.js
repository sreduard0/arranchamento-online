// CRUD ARRANCHAMENTO
//================================[RESGISTRANDO ARRANCHAMENTO]================================//
function arranchar() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        date: $('input[name=date]').val(),
        brekker: $('input[name=brekker]:checked').attr('value'),
        lunch: $('input[name=lunch]:checked').attr('value'),
        dinner: $('input[name=dinner]:checked').attr('value')
    };

    if (data.brekker == undefined) {
        data.brekker = 0
    }
    if (data.lunch == undefined) {
        data.lunch = 0
    }
    if (data.dinner == undefined) {
        data.dinner = 0
    }

    if (data.date == '') {

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Selecione uma data.'
        });

        return false;
    }

    var partsDate = data.date.split("-");
    var day = new Date(partsDate[2], partsDate[1] - 1, partsDate[0]);
    if (!moment(moment(day).format('YYYY-MM-DD')).isAfter(moment().format('YYYY-MM-DD'))) {

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Selecione uma data à partir de amanhã.'
        });

        return false;
    }

    if (data.brekker == "0" && data.lunch == "0" && data.dinner == "0") {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Selecione pelo menos uma refeição.'
        });

        return false;
    }


    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'new_arranchamento',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function(data) {

            if (data == "error") {
                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp Você já está arranchado para este dia.'
                });
            } else {
                $("#arrancharse").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Arranchado com sucesso.'
                });
                $('#form-arranchar')[0].reset();

            }
        },

        error: function(data) {
            Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp  Erro ao arranchar.'
            });
        }
    });

}
//================================[EDITANDO RESGISTRANDO ARRANCHAMENTO]================================//
function editarranchamento() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        id: $('input[name=id]').attr('value'),
        brekker: $('input[name=ebrekker]:checked').attr('value'),
        lunch: $('input[name=elunch]:checked').attr('value'),
        dinner: $('input[name=edinner]:checked').attr('value')
    };

    if (data.brekker == undefined) {
        data.brekker = 0
    }
    if (data.lunch == undefined) {
        data.lunch = 0
    }
    if (data.dinner == undefined) {
        data.dinner = 0
    }

    if (data.brekker == "0" && data.lunch == "0" && data.dinner == "0") {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Selecione pelo menos uma refeição.'
        });

        return false;
    }


    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'edit_arranchamento',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function(data) {

            if (data == "error") {
                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp Você já está arranchado para este dia.'
                });
            } else {
                $("#editarranchamento").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Arranchamento alterado com sucesso.'
                });
                $('#form-editarranchar')[0].reset();
            }
        },

        error: function(data) {
            Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp  Erro ao alterar arranchamento atualiza a página.'
            });
        }
    });

}
$('#editarranchamento').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id');
    var modal = $(this)
    var url = 'get_edit_arranchamento/' + id;
    $('#form-editarranchar')[0].reset();
    $.get(url, function(result) {
        modal.find('.modal-title').text('Editar arranchamento')
        modal.find('#id').val(result.id)
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
//================================[DELETAR ARRANCHAMENO]================================//
function delete_arranchamento(id) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir este arranchamento?',
        message: '<strong>Essa operação apagara seu arranchamento, mas você pode se arranchar novamente!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
                $.ajax({
                    url: "/arranchamento/delete/" + id,
                    type: "GET",
                    success: function(data) {
                        $("#table").DataTable().clear().draw(6);
                        Toast.fire({
                            icon: 'success',
                            title: '&nbsp&nbsp Arranchamento excluido.'
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
// FIM CRUD ARRANCHAMENTO


// CRUD CARDAPIO
//RESGISTRANDO/EDITANDO CARDAPIO
function new_menu() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        id_edit: $('input[name=id_edit]').val(),
        date: $('input[name=date]').val(),
        h_ccsv: $('input[name=h_ccsv]').val(),
        h_cia1: $('input[name=h_cia1]').val(),
        h_cia2: $('input[name=h_cia2]').val(),
        h_cia3: $('input[name=h_cia3]').val(),
        brekker: $('#brekker').val(),
        lunch: $('#lunch').val(),
        dinner: $('#dinner').val()
    };

    if (data.brekker == '') {
        data.brekker = 'Sem cardápio'
    }
    if (data.lunch == '') {
        data.lunch = 'Sem cardápio'
    }
    if (data.dinner == '') {
        data.dinner = 'Sem cardápio'
    }



    if (data.date == '') {

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Selecione uma data.'
        });

        return false;
    }

    if (data.h_ccsv == '' || data.h_cia1 == '' || data.h_cia2 == '' || data.h_cia3 == '') {

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Selecione o horário de deslocamento das CIAs.'
        });

        return false;
    }

    if (data.id_edit == '') {

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: 'new_menu',
            type: 'POST',
            data: data,
            dataType: 'text',
            success: function(data) {

                if (data == "error") {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Já existe um cardápio para este dia.'
                    });
                } else {
                    $("#menu").modal('hide');
                    $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Cardápio adicionado com sucesso.'
                    });
                    $('#form-menu')[0].reset();

                }
            },

            error: function(data) {
                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp  Erro no adicionar.'
                });
            }
        });
    } else {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: 'edit_menu',
            type: 'POST',
            data: data,
            dataType: 'text',
            success: function(data) {

                if (data == "error") {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Já existe um cardápio para este dia.'
                    });
                } else {
                    $("#menu").modal('hide');
                    $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Cardápio editado.'
                    });
                    $('#form-menu')[0].reset();

                }
            },

            error: function(data) {
                Toast.fire({
                    icon: 'error',
                    title: '&nbsp&nbsp  Erro.'
                });
            }
        });
    }

}
// EDITAR CARDAPIO
function edit_menu(id) {
    var url = 'get_edit_menu/' + id;
    $.get(url, function(result) {
        document.getElementById('id_edit').value = result.id;
        document.getElementById('date_').value = moment(result.date).format('DD-MM-YYYY');
        document.getElementById('h_ccsv_').value = result.h_ccsv;
        document.getElementById('h_cia1_').value = result.h_cia1;
        document.getElementById('h_cia2_').value = result.h_cia2;
        document.getElementById('h_cia3_').value = result.h_cia3;
        $(".menu_brekker").summernote('code', result.brekker);
        $(".menu_lunch").summernote('code', result.lunch);
        $(".menu_dinner").summernote('code', result.dinner);
        $("#menu").modal('show');
    })
};
//APAGAR CARDAPIOS
function delete_menu(id) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir esse cardápio?',
        message: '<strong>Essa operação não pode ser desfeita!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
                $.ajax({
                    url: "menu/delete/" + id,
                    type: "GET",
                    success: function(data) {
                        $("#table").DataTable().clear().draw(6);
                        Toast.fire({
                            icon: 'success',
                            title: '&nbsp&nbsp Cardápio excluido.'
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

// FIM CRUD CARDAPIO






















// //================================[RESGISTRANDO SAIDA]================================//
// function confirm_exit(id) {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });

//     bootbox.confirm({
//         title: ' Deseja encerrar esta visita ?',
//         message: '<strong>Essa operação não pode ser desfeita!</strong> <br> Lembre-se de recolher o cracha do visitante e verificar se o mesmo não esqueceu nada nas dependencias da OM.',
//         callback: function(confirmacao) {

//             if (confirmacao)
//                 $.ajax({
//                     url: location + "record/finish/" + id,
//                     type: "GET",
//                     success: function(data) {
//                         $("#table").DataTable().clear().draw(6);
//                         Toast.fire({
//                             icon: 'success',
//                             title: '&nbsp&nbsp Visita encerrada com sucesso.'
//                         });

//                     },
//                     error: function(data) {
//                         Toast.fire({
//                             icon: 'error',
//                             title: '&nbsp&nbsp Erro ao encerrar visita'
//                         });

//                     }
//                 });
//         },
//         buttons: {
//             cancel: {
//                 label: 'Cancelar',
//                 className: 'btn-default'
//             },
//             confirm: {
//                 label: 'Encerrar',
//                 className: 'btn-success'
//             }

//         }
//     });
// }

// //================================[ADICIONAR EMPRESA]================================//
// function add_enterprise() {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });


//     var data = {
//         enterprise: enterprise.value,
//         phone: phone.value,
//         street: street.value,
//         number: number.value,
//         district: district.value,
//         city: city.value
//     };


//     if (
//         data.enterprise == "" ||
//         data.phone == "" ||
//         data.street == "" ||
//         data.number == "" ||
//         data.district == "" ||
//         data.city == ""
//     ) {

//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
//         });

//         return false;
//     }

//     if (data.phone.replace(/\D+/g, "").length < 11) {
//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Número de telefone incorreto.'
//         });
//         return false;
//     }



//     $.ajax({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//         url: '/enterprise/add',
//         type: 'POST',
//         data: data,
//         dataType: 'text',
//         success: function(data) {

//             if (data == "error") {

//                 Toast.fire({
//                     icon: 'error',
//                     title: '&nbsp&nbsp Essa empresa já está cadastrada.'
//                 });
//             } else {

//                 $("#register").modal('hide');
//                 $("#table").DataTable().clear().draw(6);
//                 Toast.fire({
//                     icon: 'success',
//                     title: '&nbsp&nbsp Empresa cadastrada com sucesso.'
//                 });

//                 $('#form-enterprise')[0].reset();

//             }

//         },

//         error: function(data) {
//             Toast.fire({
//                 icon: 'error',
//                 title: '&nbsp&nbsp Erro ao cadastrar.'
//             });
//         }
//     });
// }

// //================================[EDITAR EMPRESA]================================//
// function edit_enterprise() {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });


//     var data = {
//         id: id.value,
//         new_name: newName.value,
//         new_phone: newPhone.value,
//         new_address: newAddress.value,
//     };


//     if (data.new_name == "" || data.new_phone == "" || data.new_address == "") {

//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
//         });

//         return false;
//     }

//     if (data.new_phone.replace(/\D+/g, "").length < 11) {
//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Número de telefone incorreto.'
//         });
//         return false;
//     }




//     $.ajax({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//         url: '/enterprise/edit',
//         type: 'POST',
//         data: data,
//         dataType: 'text',
//         success: function(data) {
//             if (data == "error") {

//                 Toast.fire({
//                     icon: 'error',
//                     title: '&nbsp&nbsp Uma empresa com este nome já está cadastrada.'
//                 });
//             } else {

//                 $("#enterprise_edit").modal('hide');
//                 $("#table").DataTable().clear().draw(6);
//                 Toast.fire({
//                     icon: 'success',
//                     title: '&nbsp&nbsp Empresa alterada com sucesso.'
//                 });

//                 $('#form-enterprise')[0].reset();

//             }
//         },

//         error: function(data) {
//             Toast.fire({
//                 icon: 'error',
//                 title: '&nbsp&nbsp Erro ao cadastrar.'
//             });
//         }
//     });
// }

// //================================[ADICIONAR VISITANTE]================================//
// function add_visitor() {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });


//     var data = {
//         image_profile: image_profile.value,
//         name: name_visitor.value,
//         cpf: cpf.value,
//         phone: phone.value,
//         cnh: cnh.value,
//         enterprise_id: enterprise_id.value,
//     };


//     if (
//         data.image_profile == "" ||
//         data.cpf == "" ||
//         data.phone == "" ||
//         data.cnh == "" ||
//         data.enterprise_id == "" ||
//         data.name == ""
//     ) {

//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
//         });

//         return false;
//     }

//     if (data.cpf.replace(/\D+/g, "").length < 11) {
//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Número de CPF incorreto.'
//         });
//         return false;
//     }

//     if (data.phone.replace(/\D+/g, "").length < 11) {
//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Número de telefone incorreto.'
//         });
//         return false;
//     }



//     $.ajax({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//         url: '/visitor/add',
//         type: 'POST',
//         data: data,
//         dataType: 'text',
//         success: function(data) {

//             if (data == "error") {

//                 Toast.fire({
//                     icon: 'error',
//                     title: '&nbsp&nbsp Esse(a) visitante já está cadastrada.'
//                 });
//             } else {

//                 $("#register").modal('hide');
//                 $("#table").DataTable().clear().draw(6);
//                 Toast.fire({
//                     icon: 'success',
//                     title: '&nbsp&nbsp Visitante cadastrado(a) com sucesso.'
//                 });

//                 $('#form-visitor')[0].reset();
//                 $(".select2").val('').trigger('change');

//             }

//         },

//         error: function(data) {
//             Toast.fire({
//                 icon: 'error',
//                 title: '&nbsp&nbsp Erro ao cadastrar.'
//             });
//         }
//     });
// }

// }

// //================================[ADICIONAR DESTINO]================================//
// function add_destination() {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });


//     var data = {
//         destination: destination.value,
//         color: color.value,
//     };


//     if (
//         data.destination == "" ||
//         data.color == ""

//     ) {

//         Toast.fire({
//             icon: 'error',
//             title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
//         });

//         return false;
//     }

//     $.ajax({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//         url: '/destination/add',
//         type: 'POST',
//         data: data,
//         dataType: 'text',
//         success: function(data) {

//             if (data == "error") {

//                 Toast.fire({
//                     icon: 'error',
//                     title: '&nbsp&nbsp Esse destino já existe.'
//                 });
//             } else {

//                 $("#register").modal('hide');
//                 $("#table").DataTable().clear().draw(6);
//                 Toast.fire({
//                     icon: 'success',
//                     title: '&nbsp&nbsp Destino adicionado com sucesso.'
//                 });

//                 $('#form-destination')[0].reset();

//             }

//         },

//         error: function(data) {
//             Toast.fire({
//                 icon: 'error',
//                 title: '&nbsp&nbsp Erro ao adicionar.'
//             });
//         }
//     });
// }

// //================================[DELETAR DESTINO]================================//
// function delete_destination(id) {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });

//     bootbox.confirm({
//         title: ' Deseja excluir esse destino?',
//         message: '<strong>Essa operação não pode ser desfeita!</strong>',
//         callback: function(confirmacao) {

//             if (confirmacao)
//                 $.ajax({
//                     url: "/destination/delete/" + id,
//                     type: "GET",
//                     success: function(data) {
//                         $("#table").DataTable().clear().draw(6);
//                         Toast.fire({
//                             icon: 'success',
//                             title: '&nbsp&nbsp Destino excluido.'
//                         });

//                     },
//                     error: function(data) {
//                         Toast.fire({
//                             icon: 'error',
//                             title: '&nbsp&nbsp Erro excluir.'
//                         });

//                     }
//                 });
//         },
//         buttons: {
//             cancel: {
//                 label: 'Cancelar',
//                 className: 'btn-default'
//             },
//             confirm: {
//                 label: 'Excluir',
//                 className: 'btn-danger'
//             }

//         }
//     });
// }

// //================================[RESGISTRANDO FIM DE EXPEDIENTE]================================//
// function finish_all(id) {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });

//     bootbox.confirm({
//         title: ' Deseja encerrar o expediente?',
//         message: '<strong>Essa operação não pode ser desfeita!</strong> <br> Lembre-se de avisar a guarda que há civis nas dependências da OM.',
//         callback: function(confirmacao) {

//             if (confirmacao)
//                 $.ajax({
//                     url: '/finish_all',
//                     type: "GET",
//                     success: function(data) {
//                         $("#table").DataTable().clear().draw(6);
//                         Toast.fire({
//                             icon: 'success',
//                             title: '&nbsp&nbsp Expediente encerrado com sucesso.'
//                         });

//                     },
//                     error: function(data) {
//                         Toast.fire({
//                             icon: 'error',
//                             title: '&nbsp&nbsp Erro ao encerrar'
//                         });

//                     }
//                 });
//         },
//         buttons: {
//             cancel: {
//                 label: 'Cancelar',
//                 className: 'btn-default'
//             },
//             confirm: {
//                 label: 'Encerrar',
//                 className: 'btn-success'
//             }

//         }
//     });
// }

// //================================[BUSCANDO RELATORIOS]================================//
// function search_reports() {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top-end',
//         showConfirmButton: false,
//         timer: 4000
//     });

//     var data = {
//         visitor_id: visitor_id.value,
//         enterprise_id: enterprise_id.value,
//         destination_id: destination_id.value,
//         datefrom: datefrom.value,
//         dateto: dateto.value
//     };

//     $('#table').DataTable().column(1).search(data.visitor_id).column(2).search(data.enterprise_id).column(3).search(data.destination_id).column(6).search(data.datefrom).column(7).search(data.dateto).draw();

// }