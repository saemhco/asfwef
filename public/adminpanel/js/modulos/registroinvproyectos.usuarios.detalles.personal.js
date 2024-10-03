$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuarios_detalles = $("#tbl_usuarios_detalles").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroinvproyectos/datatablePersonal/" + id_proyecto, "type": "POST"},
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [
            {
                "targets": 0,
                "className": "text-center"
            }],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false},
            {"data": "apellidos_nombres", "name": "apellidos_nombres"}
            //{"data": "estado", "name": "estado"}
        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_usuarios_detalles'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html_accion = "";
            if (data.accion === '0') {
                html_accion = '<span class="label label-primary">LECTURA</span>';
            } else if (data.accion === '1') {
                html_accion = '<span class="label label-success">EDICIÓN</span>';
            }
            $('td', row).eq(2).html(html_accion);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(3).html(html_estado);
        }
    });




    $("#form_usuarios_detalles").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5),
        maxWidth: 600,
        //height: 'auto',
        height: 450,
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Usuarios: Personal Administrativo</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }, {
                //le agregas  "id","graba" Para validar lo del enter
                html: "<i class='fa fa-save'></i>&nbsp; Grabar", "id": "graba",
                "class": "btn btn-info",
                click: function () {
                    $(".errorforms").hide();

                    var id_usuario = $("#input-id_usuario").val();
                    var id_usuario_oculto = $("#input-id_usuario_oculto").val();
                    var id_tabla = $("#input-id_tabla").val();

                    $.ajax({
                        url: base_url + "registroinvproyectos/getAjaxValidarUsuarioPersonal",
                        type: 'POST',
                        data: {id_usuario: id_usuario, id_usuario_oculto: id_usuario_oculto, id_tabla: id_tabla},
                        success: function (msg) {

                            if (msg.say === "existe") {
                                //$('#tbl_autores').dataTable().fnDraw();
                                console.log("No puede insertar");
                                var warning = '<div class="text-danger errorforms">Usuario ya registrado...</div>';
                                $("#input-warning").after(warning);
                                //window.location.href = base_url + "formatos1/registro/" + xsmart;
                            } else if (msg.say === "editar" || msg.say === "no_existe") {

                                frm = $("#form_usuarios_detalles");
                                $.ajax({
                                    url: frm.attr("action"),
                                    type: 'POST',
                                    data: frm.serialize(),
                                    success: function (msg) {
                                        var result = msg;
                                        if (result.say === "yes")
                                        {

                                            $('#tbl_usuarios_detalles').dataTable().fnDraw();
                                            bootbox.alert("<strong>Se registró correctamente</strong>");
                                            $("#form_usuarios_detalles").dialog("close");
                                        } else {
                                            console.log("llegamos a la disco");
                                            $(".errorforms").remove();

                                            $.each(result, function (i, val) {
                                                $("#input-" + i).focus();
                                                $("#input-" + i).after(val);
                                            });
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });






    //valida enter
    $("#form_usuarios_detalles .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar_usuarios() {
    //Limpia los errores y resetea los valores de los campos
    $("#input-id_proyecto_investigador_personal").val("");
    $('#input-id_usuario').val(0);
    $('#input-id_usuario').select2({
        dropdownParent: $('#form_usuarios_detalles')
    });
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $("#form_usuarios_detalles")[0].reset();
    $("#form_usuarios_detalles").dialog("open");
    $(".form_medios").remove();


}


function editar_usuarios() {
    //desabilitamos check estado
    $('#input-id_usuario').select2({
        dropdownParent: $('#form_usuarios_detalles')
    });


    $(".form_medios").remove();
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registroinvproyectos/getAjaxUsuarioDetallePersonal",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    //console.log(val);
                    $("#input-" + i).val(val);
                    if (i === "codigo") {
                        $('#input-id_usuario').val(val).trigger('change');
                        $('#input-id_usuario_oculto').val(val);
                    }
                    if(i === 'id_proyecto_investigador'){
                        $('#input-id_proyecto_investigador_personal').val(val);
                    }

                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_usuarios_detalles").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar_usuarios() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        console.log(xsmart);
        bootbox.dialog({
            message: "<strong>¿ Desea Eliminar este registro ?</strong>",
            title: "Confirmar",
            buttons: {
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                },
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "registroinvproyectos/eliminarUsuarioDetallePersonal",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_usuarios_detalles').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
                }

            }
        });
    } else {
        errordialogtablecuriosity();
    }
}
