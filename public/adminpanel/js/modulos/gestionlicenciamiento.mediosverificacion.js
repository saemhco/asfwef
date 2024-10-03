$(document).ready(function () {


//alert("Hola Mundo");



    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_medios = $("#tbl_medios").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionlicenciamiento/datatableMediosverificacion", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "codigo_indicador", "name": "indicadores.codigo"},
            {"data": "codigo", "name": "medios_verificacion.codigo"},
            {"data": "nombre", "name": "medios_verificacion.nombre"},
            {"data": "archivo", "name": "medios.archivo"},
            {"data": "estado", "name": "medios.estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_medios'), breakpointDefinition);
            }
        },
        "columnDefs": [
            {"width": "70px", "targets": 5}
        ],
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var pdf = '';
            var excel = '';
            var enlace = '';

            if (String(data.archivo).length > 9) {
                var pdf = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/mediosverificacion/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            }
            if (String(data.archivo2).length > 9) {
                var excel = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/mediosverificacion/" + data.archivo2 + "' >   <i class='fa fa-file-excel' ></i></a>";
            }
            if (String(data.enlace).length > 9) {
                var enlace = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' id='archivo_medios' href='" + data.enlace + "'  >   <i class='fa fa-link' ></i></a>";
            }

            var html = pdf + ' ' + excel + ' ' + enlace;

            $('td', row).eq(4).html(html);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(4).html(html_estado);






        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_medios').dataTable().fnFilter(this.value);
                }
            });
        }
    });






    //exito datos guardados
    $("#exito_medios").dialog({
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
                    window.location.href = base_url + "gestionlicenciamiento";
                }
            }]
    });

    $("#alerta_editar").dialog({
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


        //validamos el tamaño del caracter
        var chars = $("#input-codigo").val().length;

        //alert(chars);

        if (chars > 10) {
            //alert("Este campo solo debe tener 10 caracteres");

            $("#modal_caracter_1").dialog("open");
            CuriositySoundError();


        } else if (chars < 10) {
            //alert("Este campo debe tener 10 caracteres");

            $("#modal_caracter_2").dialog("open");
            CuriositySoundError();
        } else {
            frmx = $("#form_medios");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_medios"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());

            //frm.append('compromiso', editor_compromiso.getData());
            //frm.append('compromiso_cooperante', editor_compromiso_cooperante.getData());

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
                        //window.location.href = base_url + "medios";

                        $("#exito_medios").dialog("open");
                        CuriositySoundError();

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
        }












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

    //mensaje no existe archivo
    $("#archivo_no_existe").dialog({
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

    //modal caracter 1
    $("#modal_caracter_1").dialog({
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
                    $('#input-id_medio').focus();
                }
            }]
    });

    //modal caracter 2
    $("#modal_caracter_2").dialog({
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



    //valida enter
    $("#form_medios .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#input-condicion").on("change", function () {
        carga_componentes($(this).val(), 0);
        var html = '<option value="">Indicadores</option>';
        $("#input-indicador").html(html);
        //alert("Testing");
    });


    function carga_componentes(id_condicion, param) {
        $.post(base_url + "gestionlicenciamiento/getComponentesMediosverificacion", {condicion: id_condicion}, function (response) {
            var html = "";
            html = html + '<option value="">Componente</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.id_componente + '">' + val.nombre + '</option>';
                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.id_componente + '" selected >' + val.nombre + '</option>';
                    } else {
                        html = html + '<option value="' + val.id_componente + '">' + val.nombre + '</option>';
                    }
                }

            });

            $("#input-componente").html(html);
        }, "json");
    }



    $("#input-componente").on("change", function () {
        carga_indicadores($("#input-componente").val(), 0);
    });


    function carga_indicadores(id_componente, param) {

        //console.log("componente:"+id_componente);

        $.post(base_url + "gestionlicenciamiento/getIndicadoresMediosverificacion", {componente: id_componente}, function (response) {
            var html = "";
            html = html + '<option value="">Indicador</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.id_indicador + '">' + val.nombre + '</option>';
                } else {
                    if (val.id_indicador == param) {

                        html = html + '<option value="' + val.id_indicador + '" selected >' + val.nombre + '</option>';
                    } else {
                        html = html + '<option value="' + val.id_indicador + '">' + val.nombre + '</option>';
                    }
                }

            });

            $("#input-indicador").html(html);
        }, "json");

    }

    $("#input-indicador").on("change", function () {
        //carga_medios($("#input-indicador").val(), 0);
        var input_nombre = $("#input-indicador option:selected").attr("value");
        console.log("id_indicador:" + input_nombre);
        $("#input-id_medio").val(input_nombre + '-' + 'MV');
        $("#input-id_indicador").val(input_nombre);


    });

});



function getarchivos(archivo_medio) {
    //console.log(string);
    //alert(id_medio);
    //var xsmart = id_medio;

    $.ajax({
        type: 'POST',
        url: base_url + "gestionlicenciamiento/getArchivosMediosverificacion",
        data: {archivo_medio: archivo_medio},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {

                window.open(base_url + 'adminpanel/archivos/mediosverificacion/' + response.archivo_medio, '_blank');

            } else {

                //alert("No existe archivo");

                $("#archivo_no_existe").dialog("open");
                CuriositySoundError();

            }

            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_curriculas").dialog("open");
            //alert('Estado:' + estado);

        }
    });
}


function agregar() {

    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_medio").val("");
    $("#form_medios")[0].reset();
    $("#form_medios").dialog("open");

    //$("#error_agregar").dialog("open");
    //CuriositySoundError();
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        $.ajax({
            url: base_url + "gestionlicenciamiento/getAjaxPermisoMediosverificacion",
            type: 'POST',
            data: {id: xsmart},
            success: function (msg) {

                if (msg.say === "yes") {
                    //$('#tbl_autores').dataTable().fnDraw();
                    console.log(msg.say);
                    window.location.href = base_url + "gestionlicenciamiento/registromediosverificacion/" + xsmart;
                } else if (msg.say === "no") {
                    $("#alerta_editar").dialog("open");
                    CuriositySoundError();
                }
            }
        });



    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {

    //$("#error_agregar").dialog("open");
    //CuriositySoundError();
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
                            url: base_url + "gestionlicenciamiento/eliminarMediosverificacion",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_medios').dataTable().fnDraw();
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

function detelepdf() {
    var xsmart = id;
    //alert(xsmart);
    bootbox.dialog({
        message: "<strong>¿ Está seguro que desea eliminar el documento ?</strong>",
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
                        url: base_url + "gestionlicenciamiento/deletepdfMediosverificacion",
                        type: 'POST',
                        data: {"id": xsmart},
                        success: function (msg) {

                            if (msg.say == "yes") {
                                window.location.href = base_url + "gestionlicenciamiento/registromediosverificacion/" + id;
                            } else {

                            }
                        }
                    });
                }
            }
        }
    });

}

function deleteexcel() {
    var xsmart = id;
    bootbox.dialog({
        message: "<strong>¿ Está seguro que desea eliminar el documento ?</strong>",
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
                        url: base_url + "gestionlicenciamiento/deleteexcelMediosverificacion",
                        type: 'POST',
                        data: {"id": xsmart},
                        success: function (msg) {

                            if (msg.say == "yes") {
                                window.location.href = base_url + "gestionlicenciamiento/registromediosverificacion/" + id;
                            } else {

                            }
                        }
                    });
                }
            }
        }
    });

}