$(document).ready(function () {

    //validar anio
    if (id1 === '') {
        //cargamos codigo automatico segun select año
        var ano_eje = $("#input-ano_eje option:selected").val();
        //alert(ano_eje);
        carga_objetivosei(ano_eje);
        function carga_objetivosei(ano_eje) {
            $.post(base_url + "registroaeii/getObjetivos", {ano_eje: ano_eje}, function (response) {
                var html = "";
                html = html + '<option value="">Seleccione...</option>';
                $.each(response, function (i, val) {
                    console.log(val.descripcion);
                    var res_descripcion = val.descripcion.substr(0, 60);
                    html = html + '<option value="' + val.id_objetivo_ei + '" ano_eje = "' + val.ano_eje + '"> ' + val.id_objetivo_ei + ' - ' + val.descripcion + '...' + '</option>';

                });
                $("#input-id_objetivo_ei").html(html);
            }, "json");
        }
    }
    //fin validar año

    //select año
    $("#input-ano_eje").on("change", function () {

        var ano_eje = $(this).val();

        if (ano_eje === '') {

            //alert("Selecione el objetivo");
            $("#error_ano_eje").dialog("open");
            CuriositySoundError();

        } else {
            carga_objetivosei(ano_eje);
            function carga_objetivosei(ano_eje) {
                $.post(base_url + "registroaeii/getObjetivos", {ano_eje: ano_eje}, function (response) {
                    var html = "";
                    html = html + '<option value="">Seleccione...</option>';
                    $.each(response, function (i, val) {
                        console.log(val.descripcion);
                        var res_descripcion = val.descripcion.substr(0, 60);
                        html = html + '<option value="' + val.id_objetivo_ei + '" ano_eje = "' + val.ano_eje + '"> ' + val.id_objetivo_ei + ' - ' + val.descripcion + '...' + '</option>';

                    });
                    $("#input-id_objetivo_ei").html(html);
                }, "json");
            }
        }
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
    tbl_registroaeii = $("#tbl_registroaeii").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroaeii/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "id_indicador_aei", "name": "id_indicador_aei"},
            {"data": "ano_eje", "name": "ano_eje"},
            {"data": "id_accion_ei", "name": "id_accion_ei"},
            {"data": "nombre", "name": "nombre"},
            {"data": "descripcion", "name": "descripcion"},
            {"data": "estado", "name": "estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_registroaeii'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            console.log("ano_eje:" + data.ano_eje);
            //var html = '<input type="hidden" id="ano_eje_pk" name="ano_eje_pk" value="' + data.ano_eje_pk + '">';
            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_indicador_aei + '" pk2="' + data.ano_eje + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);

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
                    $('#tbl_registroaeii').dataTable().fnFilter(this.value);
                }
            });
        }
    });
    //exito datos guardados
    $("#exito_registroaeii").dialog({
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
                    window.location.href = base_url + "registroaeii";
                }
            }]
    });



    //error objetivo
    $("#error_objetivosei").dialog({
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
                    window.location.href = base_url + "registroaeii/registro";
                }
            }]
    });

    //
    //Error encuesta ya registrada para esa asignatura
    $("#error_indicadoresei").dialog({
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
                    window.location.href = base_url + "registroaeii/registro";
                }
            }]
    });


    //error
    $("#error_accionesei").dialog({
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
                    window.location.href = base_url + "registroaeii/registro";
                }
            }]
    });

    //error
    $("#error_ano_eje").dialog({
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
                    window.location.href = base_url + "registroaeii/registro";
                }
            }]
    });


//Publicar form
    $("#publicar").on("click", function () {
        var objetivoei = $("#input-id_objetivo_ei option:selected").val();
        var indicadorei = $("#input-id_indicador_ei option:selected").val();
        var id_accion_ei = $("#input-id_accion_ei option:selected").val();

        if (objetivoei === '') {
            $("#error_objetivosei").dialog("open");
            CuriositySoundError();
        } else {
            if (indicadorei === '') {
                $("#error_indicadoresei").dialog("open");
                CuriositySoundError();
            } else {
                if (id_accion_ei === '') {

                    $("#error_accionesei").dialog("open");
                    CuriositySoundError();

                    //alert("tipo vacio");

                } else {
                    frmx = $("#form_registroaeii");
                    //var datos = $("#form_mantenimientos").serialize();
                    //var datos = $("#form_docentes");
                    var frm = new FormData(document.getElementById("form_registroaeii"));
                    //datos += "&contenido=" + encodeURIComponent(editor.getData());
                    //frm.append('texto_muestra', editor.getData());
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
                                //window.location.href = base_url + "registroaeii";
                                $("#exito_registroaeii").dialog("open");
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
            }
        }

    });
    //valida enter
    $("#form_registroaeii .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter


    $("#input-id_accion_ei").on("change", function () {

        var ano_eje = $("#input-ano_eje option:selected").val();
        //alert(ano_eje);


        var id_accion_ei = $(this).val();

        if (id_accion_ei === '') {

            //alert("Selecione el objetivo");
            $("#error_accionesei").dialog("open");
            CuriositySoundError();

        } else {

            //
            $.ajax({
                type: 'POST',
                url: base_url + "registroaeii/getIndicadoresaei",
                data: {id_accion_ei: id_accion_ei, ano_eje: ano_eje},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'si') {
                        //alert(response.pk_aumenta);

                        var id_indicador_aei = response.pk_aumenta;



                        if (id_indicador_aei === 2 || id_indicador_aei === 3 || id_indicador_aei === 4 || id_indicador_aei === 5 || id_indicador_aei === 6 || id_indicador_aei === 7 || id_indicador_aei === 8 || id_indicador_aei === 9) {

                            //id_indicador_aei_n = parseInt(id_indicador_aei) + 1;
                            //alert(id_indicador_aei);
                            var codigo_nuevo = "I" + id_accion_ei + ".0" + id_indicador_aei;
                            $("#input-codigo").val(codigo_nuevo);

                        } else {


                            //alert("Testing");

                            //id_indicador_aei_n = parseInt(id_indicador_aei) + 1;

                            var codigo_nuevo = "I" + id_accion_ei + "." + id_indicador_aei;
                            $("#input-codigo").val(codigo_nuevo);
                        }



                    } else {

                        //alert('No existe id');
                        var codigo_nuevo = "I" + id_accion_ei + ".01";
                        $("#input-codigo").val(codigo_nuevo);

                    }

                    $(".errorforms").remove();
                }, complete: function () {
                    //$("#form_curriculas").dialog("open");
                    //alert('Estado:' + estado);

                }
            });
            //






        }



    });

    //
    $("#input-ano_eje").on("change", function () {
        $("#input-codigo").val('');
    });


    //objetivos ei select
    $("#input-id_objetivo_ei").on("change", function () {
        var ano_eje = $("#input-id_objetivo_ei option:selected").attr("ano_eje");
        //alert(ano_eje);
        //carga_indicadoresei($(this).val(), 0);
        carga_accionesei($(this).val(), ano_eje);
        //alert("Testing");
    });


    function carga_accionesei(id_objetivo_ei, ano_eje) {

        $.post(base_url + "registroaeii/getAccionesei", {id_objetivo_ei: id_objetivo_ei, ano_eje: ano_eje}, function (response) {
            var html = "";
            html = html + '<option value="">Indicador</option>';
            $.each(response, function (i, val) {

                html = html + '<option value="' + val.id_accion_ei + '">' + val.id_accion_ei + ' - ' + val.descripcion + '</option>';

            });

            $("#input-id_accion_ei").html(html);
        }, "json");

    }




});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_accion_ei").val("");
    $("#form_registroaeii")[0].reset();
    $("#form_registroaeii").dialog("open");
}

//Funcion editar
function editar() {

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var ano_eje = $('input:radio[name=selrow]:checked').attr('pk2');

        //alert(xsmart);

        window.location.href = base_url + "registroaeii/registro/" + xsmart + "/" + ano_eje;
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar()
{
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var ano_eje = $('input:radio[name=selrow]:checked').attr('pk2');

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
                            url: base_url + "registroaeii/eliminar",
                            type: 'POST',
                            //data: {"id": xsmart},
                            data: {"id": xsmart, "id2": ano_eje},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_registroaeii').dataTable().fnDraw();
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