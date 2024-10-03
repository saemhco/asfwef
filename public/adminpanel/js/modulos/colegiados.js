$(document).ready(function () {

    //alert("Hola Mundo");
    //Ubigeo
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

    tbl_colegiados = $("#tbl_colegiados").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "colegiados/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "codigo", "name": "c.codigo"},
            {"data": "capitulo", "name": "ca.descripcion"},
            {"data": "apellido_paterno", "name": "c.apellido_paterno"},
            {"data": "apellido_materno", "name": "c.apellido_materno"},
            {"data": "nombres", "name": "c.nombres"},
            {"data": "nro_documento", "name": "c.nro_documento"},
            {"data": "celular", "name": "c.celular"},
            {"data": "direccion", "name": "c.direccion"},
            {"data": "habilitado", "name": "c.habilitado"},
            {"data": "estado", "name": "c.estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_colegiados'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            //if( data.tipo_inquilino_id == "1") {  
            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X' || data.estado === 'I') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(10).html(html_estado);

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_colegiados').dataTable().fnFilter(this.value);
                }
            });
        }

    });


//exito datos guardados
    $("#exito_colegiado").dialog({
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
                    window.location.href = base_url + "colegiados";
                }
            }]
    });

//Publicar form
    $("#publicar").on("click", function () {

//        var input_codigo = $('#input-codigo').val();
//
//        if (input_codigo === '') {
//            var val = '<p>Testing</p>';
//            $("#input-codigo").after(val);
//        }

        //alert("Hola Mundo");        
        frmx = $("#form_colegiados");
        //var datos = $("#form_mantenimientos").serialize();
        var datos = $("#form_colegiados");
        var frm = new FormData(document.getElementById("form_colegiados"));
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
                    //window.location.href = base_url + "colegiados";
                    //});

                    $("#exito_colegiado").dialog("open");
                    CuriositySoundError();

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    $.each(result, function (i, val) {

                        console.log("campo:" + i);
                        //console.log("valor:" + val);


                        $("#input-" + i).focus();

                        if (i === 'codigo') {

                            var val = '<div class="text-danger errorforms">El campo codigo es requerido </div>';
                            $("#input-" + i).after(val);

                        } else {

                            $("#input-" + i).after(val);
                        }




                    });
                }
            }
        });
    });

    //Error asignatura
    $("#error_colegiado_registrada").dialog({
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

    $("#codigo_colegiado_vacio").dialog({
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


    //Select region ubigeo
    $("#input-region").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia ubigeo
    function carga_provincia(idregion, param) {

        $.post(base_url + "web/getProvincias", {pk: idregion}, function (response) {
            var html = "";
            html = html + '<option value="">SELECCIONE...</option>';

            $.each(response, function (i, val) {
                
                console.log(i);
                
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
            //console.log('Llega');

            $("#input-provincia").html(html);


        }, "json");

    }
    //Select provincia-(ubigeo)
    $("#input-provincia").on("change", function () {
        $("#input-ubigeo").val("");
        carga_distrito($("#input-region").val(), $(this).val(), 0);
    });

    //cara distritos ubideo
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';
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


    $("#input-distrito").on("change", function () {
        var c_region = $("#input-region").val();
        var c_provincia = $("#input-provincia").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo").val(concat_name);
    });



});


//validar codigo existente colegiados
$("#input-codigo").focusout(function () {

    var codigo_colegiado = $("#input-codigo").val();

    //alert(codigo_asignatura);

    if (codigo_colegiado === '') {
        $("#codigo_colegiado_vacio").dialog("open");
        CuriositySoundError();
    } else {
        $.ajax({
            type: 'POST',
            url: base_url + "colegiados/colegiadoRegistrado",
            data: {codigo_colegiado: codigo_colegiado},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    $("#error_colegiado_registrada").dialog("open");
                    CuriositySoundError();


                } else {

                }

                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });
    }

});


function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "colegiados/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}

function agregar() {
    $("#error_agregar").dialog("open");
    CuriositySoundError();
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
                            url: base_url + "colegiados/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_colegiados').dataTable().fnDraw();
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
