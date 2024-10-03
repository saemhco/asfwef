$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_actividades = $("#tbl_actividades").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionactividades/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha", "name": "fecha"},
            {"data": "id_actividad", "name": "id_actividad"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_actividades'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            //Formateamos la fecha
            var fecha_split = data.fecha;
            var fecha_split_1 = fecha_split.split(" ");
            var fecha_split_2 = fecha_split_1[0].split("-");
            var fecha = fecha_split_2[2] + '/' + fecha_split_2[1] + '/' + fecha_split_2[0];
            $('td', row).eq(1).html(fecha);



            var actividad = "<a role='button' class='btn btn-xs btn-primary' href='" + base_url + "gestionactividades/registro/" + data.id_actividad + "' >   <i class='fa fa-list' ></i></a>";
            $('td', row).eq(2).html(actividad);
            



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_actividades').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    $("#form_actividades").dialog({
        autoOpen: false,
        height: "auto",
        width: "300px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Actividades</h4></div>",
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

                    var fecha = $("#input-fecha").val();
                    console.log("fecha" + fecha);

                    $.ajax({
                        url: base_url + "gestionactividades/getAjaxValidacion",
                        type: 'POST',
                        data: {fecha: fecha},
                        success: function (msg) {

                            if (msg.say === "yes") {
                                //$('#tbl_autores').dataTable().fnDraw();
                                console.log("No puede insertar");
                                var warning = '<div class="text-danger errorforms">fecha ya registrada...</div>';
                                $("#input-fecha").after(warning);
                                //window.location.href = base_url + "formatos1/registro/" + xsmart;
                            } else if (msg.say === "no") {
                                console.log("Si puede insertar");
                                frm = $("#form_actividades");
                                $.ajax({
                                    url: frm.attr("action"),
                                    type: 'POST',
                                    data: frm.serialize(),
                                    success: function (msg) {
                                        var result = msg;
                                        if (result.say === "yes")
                                        {

                                            $('#tbl_actividades').dataTable().fnDraw();
                                            bootbox.alert("<strong>Se registró correctamente</strong>");
                                            $("#form_actividades").dialog("close");
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

    //reporte actividades xls
    $("#form_reporte_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte </h4></div>",
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
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    //exito datos guardados
    $("#exito_actividades").dialog({
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
                    window.location.href = base_url + "actividades";
                }
            }]
    });


    $("#fecha_vacio").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });


    $("#fecha_registrada").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });








//Publicar form
    $("#publicar").on("click", function () {
        //
        var fecha = $("#input-fecha").val();
        var fecha_oculta = $("#input-fecha_oculta").val();
        if (fecha === '') {
            $("#fecha_vacio").dialog("open");
            CuriositySoundError();
        } else {
            $.ajax({
                type: 'POST',
                url: base_url + "gestionactividades/getAjaxValidacionEditar",
                data: {fecha: fecha, fecha_oculta: fecha_oculta},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'editar' || response.say === 'no_existe') {
                        frmx = $("#form_actividades_editar");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_docentes");
                        var frm = new FormData(document.getElementById("form_actividades_editar"));
                        //datos += "&contenido=" + encodeURIComponent(editor.getData());
                        //frm.append('descripcion', editor.getData());

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
                                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                                    //window.location.href = base_url + "actividades";
                                    $("#exito_actividades").dialog("open");
                                    //CuriositySoundError();

                                } else {
                                    console.log("llegamos a la disco");
                                    $(".errorforms").remove();

                                    //Mostrar mensaje error del modelo
                                    $.each(result, function (i, val) {
                                        $("#input-" + i).focus();
                                        $("#input-" + i).after(val);
                                    });
                                }
                            }
                        });
                    } else if (response.say === 'existe') {
                        $("#fecha_registrada").dialog("open");
                    }

                    $(".errorforms").remove();
                }, complete: function () {
                    //$("#form_curriculas").dialog("open");
                    //alert('Estado:' + estado);

                }
            });
        }
        //

    });


    //valida enter
    $("#form_actividades .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_actividad").val("");
    $("#form_actividades")[0].reset();
    //$("#input-estado").prop("checked", true);
    var fecha = moment().format('DD/MM/YYYY');
    //console.log("Fecha de Inicio:" + f_a);
    $("#input-fecha").val(fecha);
    $("#form_actividades").dialog("open");
}

//Funcion editar
function editar() {
//    if ($(".selrow").is(':checked')) {
//        var xsmart = $('input:radio[name=selrow]:checked').val();
//
//        window.location.href = base_url + "gestionactividades/registro/" + xsmart;
//
//
//
//    } else {
//        errordialogtablecuriosity();
//    }
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "gestionactividades/getAjax",
            data: {id_actividad: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {

                    $("#input-" + i).val(val);

                    if (i === 'fecha') {
                        //console.log("fecha:" + val);
                        var fecha_split = val;
                        var fecha_split_1 = fecha_split.split(" ");
                        var fecha_split_2 = fecha_split_1[0].split("-");
                        var fecha = fecha_split_2[2] + '/' + fecha_split_2[1] + '/' + fecha_split_2[0];
                        $("#input-fecha").val(fecha);
                    }


                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_actividades").dialog("open");
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
                            url: base_url + "gestionactividades/eliminar",
                            type: 'POST',
                            data: {"id_actividad": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_actividades').dataTable().fnDraw();
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

function detalle() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "gestionactividades/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}


//reporte actividades
function reporte_actividades_xls() {
    $(".errorforms").remove();
    $("#form_reporte_actividades_xls")[0].reset();
    $("#form_reporte_actividades_xls").dialog("open");
    //window.open(base_url + "exportar/reportegestionactividades/" + fecha_inicio + "/" + fecha_fin);

}


function reporte_xls() {
    $(".errorforms").remove();
    $("#form_reporte_xls")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_xls").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_xls").val(fecha_fin_pdf);

    $("#form_reporte_xls").dialog("open");
}

function reporte_gestionactividades_xls() {
    $(".errorforms").remove();
    if ($("#input-fecha_inicio_xls").val() === "" || $("#input-fecha_fin_xls").val() === "") {
        //console.log("Entra Aqui");
        if ($("#input-fecha_inicio_xls").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
            $("#input-fecha_inicio_xls").after(val);
        }
        if ($("#input-fecha_fin_xls").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
            $("#input-fecha_fin_xls").after(val);
        }
    } else {
        var fecha_inicio1 = $("#input-fecha_inicio_xls").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_xls").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);
        window.open(base_url + "exportar/exportargestionactividades/" + fecha_inicio + "/" + fecha_fin);
    }
}

