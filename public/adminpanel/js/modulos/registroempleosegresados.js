$(document).ready(function () {



    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_empleo = $("#tbl_empleo").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroempleosegresados/datatable", "type": "POST" },
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
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },
            { "data": "fecha_inicio", "name": "fecha_inicio" },
            { "data": "fecha_fin", "name": "fecha_fin" },
            { "data": "titulo", "name": "titulo" },
            { "data": "razon_social", "name": "razon_social" },
            { "data": "tipocontrato", "name": "tipocontrato" },
            { "data": "ciudad", "name": "ciudad" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_empleo'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class=""><input type="radio" name="selrow" class="selrow" value="' + data.id_empleo + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success" style="color:white;">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning" style="color:white;">INACTIVO</span>';
            }
            $('td', row).eq(7).html(html_estado);


        }
    });




    $("#form_empleos").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "    <div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Empleos</h4></div>",
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
                //frm = $("#form_empleos");  
                frmx = $("#form_empleos");
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
                        if (result.say === "yes") {
                            console.log("save_padre");
                            $('#tbl_empleo').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_empleos").dialog("close");



                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();

                            $.each(result, function (i, val) {

                                if (i === "id_empresa") {
                                    $("#input-warning_empresas").after(val);
                                } else {
                                    $("#input-" + i).focus();
                                    $("#input-" + i).after(val);
                                }


                                if(i === "ciudad"){
                                    $("#input-empleo-ciudad").after(val);
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
    $("#form_empleos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#input-region_id").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo_id").val("");
        var html = '<option value="">Provincias</option>';
        $("#input-distrito_id").html(html);
    });

    $("#input-provincia_id").on("change", function () {
        $("#input-ubigeo_id").val("");
        carga_distrito($("#input-region_id").val(), $(this).val(), 0);
    });

    $("#input-distrito_id").on("change", function () {
        var c_region = $("#input-region_id").val();
        var c_provincia = $("#input-provincia_id").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo_id").val(concat_name);
    });


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#form_empleos")[0].reset();
    $(".form_empleos").remove();
    $('#input-id_empresa').val("");
    $('#input-id_empresa').select2({
        dropdownParent: $('#form_empleos')
    });
    $("#form_empleos").dialog("open");
}

function editar() {
    $(".form_empleos").remove();
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registroempleosegresados/getAjax",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i).val(val);

                    if (i === "id_empresa") {

                        $('#input-id_empresa').val(val).trigger('change');

                    }

                    if (i === "ciudad") {
                        $("#input-empleo-ciudad").val(val);
                    }


                    if (i === "fecha_inicio") {
                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_inicio").val(result_fi);
                    }

                    if (i === "fecha_fin") {
                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_fin").val(result_fi);
                    }

                    if (i === "archivo") {
                        if (val === "" || val === null) {
                            var valor = '<div class="alert alert-warning fade in form_empleos"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#archivo_empleo_modal").after(valor);
                        } else {
                            var valor = '<div class="alert alert-success fade in form_empleos">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/egresados/empleos/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#archivo_empleo_modal").after(valor);
                        }
                    }



                    if (i === "imagen") {
                        if (val === "" || val === null) {
                            //console.log("Valor cuando esta vacio o es null:" + val);
                            var valor = '<div class="alert alert-warning fade in form_empleos"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un imagen.</div>';
                            $("#imagen_empleo_modal").after(valor);
                   

                        } else {
                            var valor = '<div class="alert alert-success fade in form_empleos">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/imagenes/egresados/empleos/' + val + '" >  <i class="fa-fw fa fa-image"></i></a></div>';
                            $("#imagen_empleo_modal").after(valor);

                        }
                    }



                });

                var region_id = response.region_id;
                var provincia_id = response.provincia_id;
                var distrito_id = response.distrito_id;

                carga_provincia(region_id, provincia_id);
                carga_distrito(region_id, provincia_id, distrito_id);

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_empleos").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
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
                            url: base_url + "registroempleosegresados/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_empleo').dataTable().fnDraw();
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

        $("#input-provincia_id").html(html);
    }, "json");

}

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

        $("#input-distrito_id").html(html);
    }, "json");

}