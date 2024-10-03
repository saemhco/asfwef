$(document).ready(function () {
    //alert("Hola mundo");


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_obra = $("#tbl_docentes").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registrodocentes/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            {"data": "foto", "name": "d.foto"},
            {"data": "codigo", "name": "d.codigo"},
            {"data": "apellidop", "name": "d.apellidop"},
            {"data": "apellidom", "name": "d.apellidom"},
            {"data": "nombres", "name": "d.nombres"},
            {"data": "nro_doc", "name": "d.nro_doc"},
            {"data": "celular", "name": "d.celular"},
            {"data": "titulo", "name": "d.titulo"},
            {"data": "estado", "name": "d.estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_docentes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(9).html(html_estado);

            //Mostrar imagen
            var html = "<img src='" + base_url + "adminpanel/imagenes/docentes/" + data.foto + "'   width='120' height='70'  />";
            $('td', row).eq(1).html(html);





        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_docentes').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //exito datos guardados
    $("#guarda_docentes").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [{
                html: "Aceptar",
                "class": "btn btn-success btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "registrodocentes";
                }
            }]
    });





//Publicar form
    $("#publicar").on("click", function () {
        $(".errorforms").remove();
        //vañidar si existe
        var nro_doc = $("#input-nro_doc").val();
        var estado_registrado = $("#input-estado_registrado").val();
        if (estado_registrado === "") {
            $.ajax({
                type: 'POST',
                url: base_url + "registrodocentes/docentesRegistrado",
                data: {nro_doc: nro_doc},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'yes') {
                        var val = '<div class="text-danger errorforms">El número de documento ya está registrado</div>';
                        $("#input-nro_doc").after(val);
                    } else {
                        frmx = $("#form_docentes");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_docentes");
                        var frm = new FormData(document.getElementById("form_docentes"));
                        //datos += "&contenido=" + encodeURIComponent(editor.getData());
                        //frm.append('contenido', editor.getData());

                        $.ajax({
                            url: frmx.attr("action"),
                            type: 'POST',
                            //data: frm.serialize(),
                            data: frm,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (msg) {
                                var result = msg;
                                if (result.say === "yes")
                                {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "registrodocentes";
//                    });

                                    $("#guarda_docentes").dialog("open");
                                    CuriositySoundError();


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
        } else {
            frmx = $("#form_docentes");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_docentes"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());
            //frm.append('contenido', editor.getData());

            $.ajax({
                url: frmx.attr("action"),
                type: 'POST',
                //data: frm.serialize(),
                data: frm,
                cache: false,
                contentType: false,
                processData: false,
                success: function (msg) {
                    var result = msg;
                    if (result.say === "yes")
                    {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "registrodocentes";
//                    });

                        $("#guarda_docentes").dialog("open");
                        

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

    });

    //docente nuevo
    $("#form_docente_nuevo").dialog({
        autoOpen: false,
        //height: "auto",
        width: "900px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Docentes</h4></div>",
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
                    frm = $("#form_docente_nuevo");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_docentes').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_docente_nuevo").dialog("close");
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
    $("#input-codigo").val("");
    $("#form_docente_nuevo")[0].reset();
    $("#form_docente_nuevo").dialog("open");
}



function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registrodocentes/registro/" + xsmart;
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
                            url: base_url + "registrodocentes/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_docentes').dataTable().fnDraw();
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


//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}