$(document).ready(function () {


    //Ubigeo
    if (region_id !== "") {
        carga_provincia(region_id, provincia_id);
    }

    if (provincia_id !== "") {
        //console.log("loading provincia ubigeo");
        carga_distrito(region_id, provincia_id, distrito_id);
    }

    //Lugar de procedencia
    if (region1_id !== "") {
        console.log("Region: " + region1_id);
        carga_provincia_lp(region1_id, provincia1_id);
    }



    if (provincia1_id !== "") {
        console.log("Provincia: " + provincia1_id);
        console.log("Distrito: " + distrito1_id);
        //console.log("loading provincia procedencia");
        carga_distrito_lp(region1_id, provincia1_id, distrito1_id);
    }


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_alumnos = $("#tbl_alumnos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroalumnos/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

            { "data": "id_alumno", "name": "id_alumno" },
            { "data": "carrera_nombre", "name": "carrera_nombre" },
            { "data": "alumnos_nombre", "name": "alumnos_nombre" },
            { "data": "nro_doc", "name": "nro_doc" },
            { "data": "celular", "name": "celular" },
            { "data": "estado", "name": "estado" }


        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos'), breakpointDefinition);
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
            $('td', row).eq(6).html(html_estado);

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_alumnos').dataTable().fnFilter(this.value);
                }
            });
        }

    });



    //exito datos guardados
    $("#exito_alumno").dialog({
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
                window.location.href = base_url + "registroalumnos";
            }
        }]
    });



    //Guardar Alumno
    $("#publicar").on("click", function () {
        //alert("Hola mundo");
        frmx = $("#form_alumnos");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_alumnos");
        var frm = new FormData(document.getElementById("form_alumnos"));
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
                if (result.say === "yes") {
                    //bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                    //window.location.href = base_url + "registroalumnos";
                    //});

                    $("#exito_alumno").dialog("open");
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
    });


    //mensaje error
    $("#error_agregar").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB</h4></div>",
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
            }
        }]
    });


    //Region, prvincia y distrito (ubigeo)
    $("#input-region").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo").val("");
        var html = '<option value="">Distritos</option>';
        $("#input-distrito").html(html);
    });

    $("#input-provincia").on("change", function () {
        $("#input-ubigeo").val("");
        carga_distrito($("#input-region").val(), $(this).val(), 0);
    });

    $("#input-distrito").on("change", function () {
        var c_region = $("#input-region").val();
        var c_provincia = $("#input-provincia").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo").val(concat_name);
    });

    //Funcion carga provincia
    function carga_provincia(idregion, param) {

        $.post(base_url + "btrpublicaciones/getProvincias", { pk: idregion }, function (response) {
            var html = "";
            html = html + '<option value="">Provincias</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.provincia + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input-provincia").html(html);
        }, "json");

    }


    //Funcion para cargar distritos
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "btrpublicaciones/getDistritos", { pk: idregion, idprov: idprov }, function (response) {
            var html = "";
            html = html + '<option value="">Distrito</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                } else {
                    if (val.distrito == param) {

                        html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input-distrito").html(html);
        }, "json");

    }

    //Region, prvincia y distrito (Lugar de procedencia)
    $("#input-region1").on("change", function () {
        carga_provincia_lp($(this).val(), 0);
        $("#input-ubigeo1").val("");
        var html = '<option value="">Distrito</option>';
        $("#input-distrito1").html(html);

    });

    $("#input-provincia1").on("change", function () {
        $("#input-ubigeo1").val("");
        carga_distrito_lp($("#input-region1").val(), $(this).val(), 0);
    });

    $("#input-distrito1").on("change", function () {
        var c_region1 = $("#input-region1").val();
        var c_provincia1 = $("#input-provincia1").val();
        var c_distrito1 = $(this).val();
        var concat_name1 = c_region1 + c_provincia1 + c_distrito1;
        $("#input-ubigeo1").val(concat_name1);
    });

    //Funcion para cargar provincias
    function carga_provincia_lp(idregion, param) {
        console.log("LLega parametro enviado de region: " + param);

        $.post(base_url + "btrpublicaciones/getProvincias", { pk: idregion }, function (response) {

            var html = "";
            html = html + '<option value="">Provincias</option>';


            $.each(response, function (i, val) {

                if (param == 0) {

                    html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.provincia + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input-provincia1").html(html);
        }, "json");

    }

    //Funcion para cargar distritos
    function carga_distrito_lp(idregion, idprov, param) {

        $.post(base_url + "btrpublicaciones/getDistritos", { pk: idregion, idprov: idprov }, function (response) {
            var html = "";
            html = html + '<option value="">Distrito</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                } else {
                    if (val.distrito == param) {

                        html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input-distrito1").html(html);
        }, "json");

    }

    //Funcion carga edad loading

    if ($("#input-fecha_nacimiento").val()) {

        var fecha_nacimiento = $("#input-fecha_nacimiento").val().split("/");


        var dia_nacimiento = fecha_nacimiento[0];
        var mes_nacimiento = fecha_nacimiento[1];
        var año_nacimiento = fecha_nacimiento[2];


        var fecha_actual = new Date();

        var mes_actual = fecha_actual.getMonth() + 1;
        var dia_actual = fecha_actual.getDate();
        var año_actual = fecha_actual.getFullYear();

        if (dia_actual < 10) {
            dia_actual = '0' + dia_actual;
        }

        if (mes_actual < 10) {
            mes_actual = '0' + mes_actual;
        }

        //console.log(dia_actual + '-' + mes_actual + '-' + año_actual);
        //console.log(año_nacimiento);

        if ((mes_nacimiento >= mes_actual) && (dia_nacimiento > dia_actual)) {
            var edad = (año_actual - 1) - año_nacimiento;
            //console.log(edad);
            $("#input-edad").val(edad);

        } else {
            var edad = año_actual - año_nacimiento;
            //console.log(edad);
            $("#input-edad").val(edad);
        }
    }

    //reportes
    $("#form_reportes").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i>Reportes </h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

});



function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        //Agregamos el id del semestre
        var semes = $("#semestre").val();
        window.location.href = base_url + "registroalumnos/registro/" + xsmart;
        ;
    } else {
        errordialogtablecuriosity();
    }
}




function agregar() {
    $("#error_agregar").dialog("open");
    CuriositySoundError();
}




function eliminar() {
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
                            url: base_url + "registroalumnos/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_alumnos').dataTable().fnDraw();
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


//reportes
function reportes() {
    $(".errorforms").hide();
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        //certificado_estudio(xsmart);

        //$("#input-cv").attr("href", "btrpublicaciones/descargacv/" + xsmart);
        $("#form_reportes").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}

//cv
function cv() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.open(base_url + "btrpublicaciones/descargacv/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

//certificado_estudio
function certificado_estudio() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#certificado_estudio").after(val);
}

//certificado_estudio_2
function certificado_estudio_2() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#certificado_estudio_2").after(val);
}

//record_academico
function record_academico() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#record_academico").after(val);
}

//revision_curricular
function revision_curricular() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#revision_curricular").after(val);
}

//file
function file() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#file").after(val);
}

//constancia_matricula
function constancia_matricula() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_matricula").after(val);
}

//constancia_egresado
function constancia_egresado() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_egresado").after(val);
}

//constancia_extracurricular
function constancia_extracurricular() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_extracurricular").after(val);
}

////constancia_extracurricular
function constancia_extracurricular() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_extracurricular").after(val);
}

//constancia_cien
function constancia_cien() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_cien").after(val);
}
