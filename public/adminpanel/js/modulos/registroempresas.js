$(document).ready(function () {

    //ubigeo
    if (region_id !== "") {
        carga_provincia(region_id, provincia_id);
    }

    if (provincia_id !== "") {
        //console.log("loading provincia ubigeo");
        carga_distrito(region_id, provincia_id, distrito_id);
    }

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_empresas = $("#tbl_empresas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroempresas/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "imagen", "name": "imagen"},
            {"data": "razon_social", "name": "razon_social"},
            {"data": "ruc", "name": "ruc"},
            {"data": "rubro", "name": "rubro"},
            {"data": "telefono", "name": "telefono"},
            {"data": "direccion", "name": "direccion"},
            {"data": "email", "name": "email"},
            {"data": "estado", "name": "estado"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_empresas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {
            //if( data.tipo_inquilino_id == "1") {   

            var html = "<img src='" + base_url + "adminpanel/imagenes/empresas/" + data.imagen + "'   width='90' height='60'  />";

            $('td', row).eq(1).html(html);
            //}else{
            //     $('td', row).eq(7).html('<button onclick="anadirrep('+data.id+')" class="btn btn-xs btn-info" title="añadir representante" ><i class="fa fa-user"></i></button>');
            // }

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(8).html(html_estado);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_empresas').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    //exito datos guardados
    $("#success").dialog({
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
                    window.location.href = base_url + "registroempresas";
                }
            }]
    });

    //Publicar form
    $("#publicar").on("click", function () {
        $(".errorforms").remove();
        //validar personal registrado
        var ruc = $("#input-ruc").val();
        var estado_registrado = $("#input-estado_registrado").val();

        if (estado_registrado === "") {
            $.ajax({
                type: 'POST',
                url: base_url + "registroempresas/empresasRegistrado",
                data: {ruc: ruc},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'yes') {

                        var val = '<div class="text-danger errorforms">El número de RUC ya está registrado</div>';
                        $("#input-ruc").after(val);
                    } else {
                        frmx = $("#form_empresas");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_empresas");
                        var frm = new FormData(document.getElementById("form_empresas"));
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
                                console.log("Llega cuando es nuevo");
                                var result = msg;
                                if (result.say === "yes")
                                {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "docentes";
//                    });

                                    $("#success").dialog("open");
                                    //CuriositySoundError();


                                } else if (result.say === "error_image") {

                                    var val = '<div class="text-danger errorforms">Extensión de imagen no permitida</div>';
                                    $("#input-imagen").after(val);

                                } else if (result.say === "error_archivo") {

                                    var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                                    $("#input-archivo").after(val);

                                } else if (result.say === "error_archivo_ruc") {

                                    var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                                    $("#input-archivo_ruc").after(val);

                                } else if (result.say === "error_archivo_rnp") {

                                    var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                                    $("#input-archivo_rnp").after(val);

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
            frmx = $("#form_empresas");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_empresas");
            var frm = new FormData(document.getElementById("form_empresas"));
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
                    console.log("Llega");
                    var result = msg;
                    if (result.say === "yes")
                    {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "docentes";
//                    });

                        $("#success").dialog("open");
                        //CuriositySoundError();


                    } else if (result.say === "error_image") {

                        var val = '<div class="text-danger errorforms">Extensión de imagen no permitida</div>';
                        $("#input-imagen").after(val);

                    } else if (result.say === "error_archivo") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo").after(val);

                    } else if (result.say === "error_archivo_ruc") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo_ruc").after(val);

                    } else if (result.say === "error_archivo_rnp") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo_rnp").after(val);

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

    //ubigeo
    $("#input-region").on("change", function () {
        console.log("region");
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

});


function carga_provincia(idregion, param) {

    $.post(base_url + "btrpublicaciones/getProvincias", {pk: idregion}, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';
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

function carga_distrito(idregion, idprov, param) {

    $.post(base_url + "btrpublicaciones/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';
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

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registroempresas/registro/" + xsmart;
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
                            url: base_url + "registroempresas/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_empresas').dataTable().fnDraw();
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