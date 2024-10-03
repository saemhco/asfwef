$(document).ready(function () {
    //validar anio
    if (id1 === '') {
        //cargamos codigo automatico segun select año
        var ano_eje = $("#input-ano_eje option:selected").val();
        //alert(ano_eje);
        carga_objetivosei(ano_eje);
        function carga_objetivosei(ano_eje) {
            $.post(base_url + "registrooeii/getObjetivos", { ano_eje: ano_eje }, function (response) {
                var html = "";
                html = html + '<option value="">Seleccione...</option>';
                $.each(response, function (i, val) {
                    console.log(val.descripcion);
                    var res_descripcion = val.descripcion.substr(0, 60);
                    html = html + '<option value="' + val.id_objetivo_ei + '"> ' + val.id_objetivo_ei + ' - ' + val.descripcion + '...' + '</option>';

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
                $.post(base_url + "registrooeii/getObjetivos", { ano_eje: ano_eje }, function (response) {
                    var html = "";
                    html = html + '<option value="">Seleccione...</option>';
                    $.each(response, function (i, val) {
                        console.log(val.descripcion);
                        var res_descripcion = val.descripcion.substr(0, 60);
                        html = html + '<option value="' + val.id_objetivo_ei + '"> ' + val.id_objetivo_ei + ' - ' + val.descripcion + '...' + '</option>';

                    });
                    $("#input-id_objetivo_ei").html(html);
                }, "json");
            }
        }
    });
    //

    if (id_objetivo_ei != undefined) {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;
        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };
        tbl_registrooeii = $("#tbl_registrooeii").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "registrooei/datatableOeii/" + id_objetivo_ei, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[1, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                { "data": "id_indicador_oei", "name": "id_indicador_oei" },
                { "data": "ano_eje", "name": "ano_eje" },
                { "data": "id_objetivo_ei", "name": "id_objetivo_ei" },
                { "data": "nombre", "name": "nombre" },
                { "data": "descripcion", "name": "descripcion" },
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_registrooeii'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {

                //console.log("ano_eje:" + data.ano_eje);
                //var html = '<input type="hidden" id="ano_eje_pk" name="ano_eje_pk" value="' + data.ano_eje_pk + '">';
                var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_indicador_oei + '" pk2="' + data.ano_eje + '" ><i></i> </label></center>';
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
                        $('#tbl_registrooeii').dataTable().fnFilter(this.value);
                    }
                });
            }
        });
    }




    //exito datos guardados
    $("#exito_registrooeii").dialog({
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
                history.back();
            }
        }]
    });
    //error
    $("#error_objetivoei").dialog({
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
                location.reload();
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
                location.reload();
            }
        }]
    });


    //Publicar form
    $("#publicar").on("click", function () {

        console.log("test");

        var tipo = $("#input-id_objetivo_ei option:selected").val();
        if (tipo === '') {

            $("#error_objetivoei").dialog("open");
            CuriositySoundError();

            //alert("tipo vacio");

        } else {
            frmx = $("#form_registrooeii");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_registrooeii"));
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
                    if (result.say === "yes") {
                        //bootbox.alert("<strong>Se registró correctamente</strong>");
                        //window.location.href = base_url + "registrooeii";
                        $("#exito_registrooeii").dialog("open");
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
    //valida enter
    $("#form_registrooeii .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter


    $("#input-id_objetivo_ei").on("change", function () {

        var ano_eje = $("#input-ano_eje option:selected").val();
        //alert(ano_eje);


        var id_objetivo_ei = $(this).val();

        if (id_objetivo_ei === '') {

            //alert("Selecione el objetivo");
            $("#error_objetivoei").dialog("open");
            CuriositySoundError();

        } else {

            //
            $.ajax({
                type: 'POST',
                url: base_url + "registrooeii/getIndicadoresoei",
                data: { id: id_objetivo_ei, ano_eje: ano_eje },
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'si') {
                        //alert(response.pk_aumenta);

                        var id_indicador_oei = response.pk_aumenta;



                        if (id_indicador_oei === 2 || id_indicador_oei === 3 || id_indicador_oei === 4 || id_indicador_oei === 5 || id_indicador_oei === 6 || id_indicador_oei === 7 || id_indicador_oei === 8 || id_indicador_oei === 9) {

                            //id_indicador_oei_n = parseInt(id_indicador_oei) + 1;
                            //alert(id_indicador_oei);
                            var codigo_nuevo = "I" + id_objetivo_ei + ".0" + id_indicador_oei;
                            $("#input-codigo").val(codigo_nuevo);

                        } else {


                            //alert("Testing");

                            //id_indicador_oei_n = parseInt(id_indicador_oei) + 1;

                            var codigo_nuevo = "I" + id_objetivo_ei + "." + id_indicador_oei;
                            $("#input-codigo").val(codigo_nuevo);
                        }



                    } else {

                        //alert('No existe id');
                        var codigo_nuevo = "I" + id_objetivo_ei + ".01";
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

    //validacion select anio
    $("#input-ano_eje").on("change", function () {

        $("#input-codigo").val("");

    });
    //fin



});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_objetivo_ei").val("");
    $("#form_registrooeii")[0].reset();
    $("#form_registrooeii").dialog("open");
}

//Funcion editar
function editar() {

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var ano_eje = $('input:radio[name=selrow]:checked').attr('pk2');

        //alert(xsmart);

        window.location.href = base_url + "registrooei/registrooeii/" + xsmart + "/" + ano_eje;
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
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
                            url: base_url + "registrooeii/eliminar",
                            type: 'POST',
                            //data: {"id": xsmart},
                            data: { "id": xsmart, "id2": ano_eje },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_registrooeii').dataTable().fnDraw();
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