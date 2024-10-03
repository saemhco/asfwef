$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_cursos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "moodle/datatableCursos", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "idnumber", "name": "idnumber"},
            {"data": "shortname", "name": "shortname"},
            {"data": "fullname", "name": "fullname"},
            {"data": "id", "name": "id"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_cursos'), breakpointDefinition);
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
                    $('#tbl_cursos').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );


    $("#form_cursos").dialog({
        autoOpen: false,
        width: 500, // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Cursos</h4></div>",
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
                    frm = $("#form_cursos");
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
                                $("#form_cursos").dialog("close");
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

});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-idnumber").val("");
    $("#input-id").val("");
    $("#form_cursos")[0].reset();
    $("#form_cursos").dialog("open");
}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "moodle/getAjaxCurso",
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
                $("#form_cursos").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

function migrar() {
    
        $.ajax({
            type: 'POST',
            url: base_url + "moodle/sincronizarCursos",
            data: {id: 'migrar'},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say == "yes") {
                     bootbox.alert("<strong>Se migró correctamente</strong>");
                } else {
                    bootbox.alert("<strong>No se migro ningun registro</strong>");
                }
            }, complete: function () {
                $('#tbl_usuarios').dataTable().fnDraw();
                console.log("llega");
            }
        });
    
}

function enrol(){
    $.ajax({
            type: 'POST',
            url: base_url + "moodle/sincronizarCursosRol",
            data: {id: 'migrar'},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say == "yes") {
                     bootbox.alert("<strong>Se sincronizo correctamente</strong>");
                } else {
                    bootbox.alert("<strong>No se sincronizo ningun registro</strong>");
                }
            }, complete: function () {
                $('#tbl_usuarios').dataTable().fnDraw();
                console.log("llega");
            }
    });
}

function matricula(){
    $.ajax({
            type: 'POST',
            url: base_url + "moodle/sincronizarMatriculaMoodle",
            data: {id: 'migrar'},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say == "yes") {
                     bootbox.alert("<strong>Se sincronizo correctamente</strong>");
                } else {
                    bootbox.alert("<strong>No se sincronizo ningun registro</strong>");
                }
            }, complete: function () {
                $('#tbl_usuarios').dataTable().fnDraw();
                console.log("llega");
            }
    });
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
                            url: base_url + "moodle/eliminarCurso",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_cursos').dataTable().fnDraw();
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