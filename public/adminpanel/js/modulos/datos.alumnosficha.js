$(document).ready(function () {

    //Modal Padres
    $("#open_modal_padres").on("click", function () {
        $("#modal_padres").dialog("open");
    });

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
        //console.log("Region: " + region1_id);
        carga_provincia_lp(region1_id, provincia1_id);
    }



    if (provincia1_id !== "") {
        //console.log("Provincia: " + provincia1_id);
        //console.log("Distrito: " + distrito1_id);
        //console.log("loading provincia procedencia");
        carga_distrito_lp(region1_id, provincia1_id, distrito1_id);
    }



    //Carga semestre seleccionado
    $("#semestre").on("change", function () {
        var sema = $(this).val();
        window.location.href = base_url + "alumnosficha/index/" + sema;

    });


//
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_alumnos_familiares = $("#tbl_alumnos_familiares").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "alumnosficha/datatableFamiliares/" + codigo_alumno, "type": "POST"},
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        "searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [
            {
                "targets": 0,
                "className": "text-center"
            }],
        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false},
            {"data": "nombre_parentesco", "name": "p.nombres"},
            {"data": "apellido_paterno", "name": "af.apellido_paterno"},
            {"data": "apellido_materno", "name": "af.apellido_materno"},
            {"data": "nombres", "name": "af.nombres"},
            {"data": "edad", "name": "af.edad"},
            {"data": "estado_civil", "name": "ec.nombres"},
            {"data": "grado_instruccion", "name": "gi.nombres"},
            {"data": "ocupacion", "name": "af.ocupacion"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos_familiares'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class=""><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);


        }
    });
//


//fomulrrio de familiares
    $("#form_alumnos_familiares").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "    <div class='widget-header'><h4><i class='fa fa-form'></i> Registro Familiares / Apoderados:</h4></div>",
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
                    //frm = $("#form_alumnos_familiares");  
                    frmx = $("#form_alumnos_familiares");
                    var frm = new FormData(this);

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
                                console.log("save_padre");
                                $('#tbl_alumnos_familiares').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_alumnos_familiares").dialog("close");



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
                if (result.say === "yes")
                {
                    //bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                    //window.location.href = base_url + "alumnos";
                    //});

                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                        location.reload();
                    });

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

        $.post(base_url + "btrpublicaciones/getProvincias", {pk: idregion}, function (response) {
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

        $.post(base_url + "btrpublicaciones/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
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

        $.post(base_url + "btrpublicaciones/getProvincias", {pk: idregion}, function (response) {

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

        $.post(base_url + "btrpublicaciones/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
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


//calculo de edad
    if ($("#input-fecha_nacimiento").length) {
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

});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    //var personal = $("#input-codigo").val();
    $("#form_alumnos_familiares")[0].reset();
    $(".form_alumnos_familiares").remove();
    $.ajax({
        type: 'POST',
        url: base_url + "alumnosficha/getNew",
        //data: {"personal": personal},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {
                //alert(response.codigo);

                $("#input-codigo_familiar").attr('value', response.codigo);

            }

            $(".errorforms").remove();
        }, complete: function () {
            $("#form_alumnos_familiares").dialog("open");
        }
    });
}
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "alumnosficha/getAjaxFamiliares",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i + "_familiares").val(val);
                    //console.log(i);

                    if (i === "codigo") {
                        $("#input-" + i + "_familiar").val(val);
                    }


                    if (i == "enfermedad") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "tratamiento") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "discapacidad") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "casa") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "camion") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "auto") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "mototaxi") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "predios") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "tv") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "equipo") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "animales") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }
                    if (i == "es_principal") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }

                    if (i == "mesas") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }

                    if (i == "sillas") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i + "_familiares").prop("checked", true);
                        }
                    }



                    if (i === "fecha_nacimiento") {
                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_nacimiento_familiares").val(result_fi);
                    }

                    if (i === "archivo") {
                        if (val === "" || val === null) {
                            var valor = '<div class="alert alert-warning fade in form_alumnos_familiares"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#archivo_alumno_familiares_modal").after(valor);
                        } else {
                            var valor = '<div class="alert alert-success fade in form_alumnos_familiares">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/alumnos_familiares/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#archivo_alumno_familiares_modal").after(valor);
                        }
                    }



                    if (i === "imagen") {
                        if (val === "" || val === null) {
                            //console.log("Valor cuando esta vacio o es null:" + val);
                            var valor = '<div class="alert alert-warning fade in form_alumnos_familiares"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un imagen.</div>';
                            $("#imagen_alumno_familiares_modal").after(valor);
                            $("#imagen_familiar").html(valor);

                        } else {
                            var valor = '<div class="alert alert-success fade in form_alumnos_familiares">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/imagenes/alumnos_familiares/' + val + '" >  <i class="fa-fw fa fa-image"></i></a></div>';
                            $("#imagen_alumno_familiares_modal").after(valor);

                            $("#imagen_familiar_collapse").attr("src", base_url + 'adminpanel/imagenes/alumnos_familiares/' + val);
                        }
                    }



                });


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_alumnos_familiares").dialog("open");
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
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "alumnosficha/eliminarPadre",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_alumnos_familiares').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
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