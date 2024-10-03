$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_usuarios").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "usuarios/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "usu_nombre", "name": "u.usu_nombre"},
            {"data": "usu_usuario", "name": "u.usu_usuario"},
            {"data": "perfil", "name": "p.per_descripcion"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_usuarios'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_usuarios').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );




    $("#form_usuarios").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Usuarios</h4></div>",
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
                    frm = $("#form_usuarios");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_usuarios').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_usuarios").dialog("close");
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
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });




    //valida enter
    $("#form_usuarios .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;

        }
    }); // fin validar enter

    $("#actualizaPermisos").click(function (e) {
        e.preventDefault();
        var aPermisos = [];
        var p;

        $('#tree').find('li').each(function (i, element) {
            if ($(element).hasClass("jstree-checked") || $(element).hasClass("jstree-undetermined")) {
                p = 'A';
            } else {
                p = 'X';
            }
            aPermisos.push({idm: this.id, idp: indexR, val: p});
        });

        if (aPermisos.length > 0) {
            $("#actualizaPermisos i").removeClass().addClass("fa fa-spinner fa-spin");
            $.post(base_url + "procesos/actualizarPermisos", {
                "permisos": aPermisos
            }, function (response) {
                $("#actualizaPermisos i").removeClass().addClass("fa fa-refresh");
                $("#modalpermisos").modal("hide");
                bootbox.alert("Permisos actualizados correctamente");
            }, 'json');
        } else {
            bootbox.alert("Cargue los permisos");
        }
    });


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id").val("");
    $("#form_usuarios")[0].reset();
    $("#form_usuarios").dialog("open");
}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "usuarios/getAjax",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    console.log(val);
                    $("#input-" + i).val(val);
                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_usuarios").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar()
{
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
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
                            url: base_url + "usuarios/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_usuarios').dataTable().fnDraw();
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



function permisos()
{

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        permisionrecord(xsmart);
    } else {
        errordialogtablecuriosity();

    }
}


function permisionrecord(idrecord) {
    if (idrecord) {

        getPermisos(idrecord);
        $("#modalpermisos").modal("show");
    } else {
        bootbox.alert("<h4><strong>Debe seleccionar un registro</strong></h4>");
    }
}

var getPermisos = function (usuario_id) {
    indexR = usuario_id;
    if (indexR == null) {
        $("#tree").jstree({
            plugins: ["themes", "json_data", "checkbox", "sort", "ui"],
            themes: {
                theme: "apple"
            },
            json_data: {
                ajax: {
                    url: base_url + "procesos/getPermisos",
                    data: {
                        usuario_id: 0
                    }
                }
            }
        });
    } else {
        $("#tree").jstree({
            plugins: ["themes", "json_data", "checkbox", "sort", "ui"],
            themes: {
                theme: "apple"
            },
            json_data: {
                ajax: {
                    url: base_url + "procesos/getPermisos",
                    data: {
                        usuario_id: usuario_id
                    }
                }
            }
        });
    }
};