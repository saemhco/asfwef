$(document).ready(function () {

    //alert(xAbrevIns);
    //CKeditor
    if (publica == "si") {

        //Visto
        var editor_perfil = CKEDITOR.replace('perfil_ckeditor', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbar_Basic: [

                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
                {name: 'document', items: ['Source']}
            ],
            toolbar_Full: [
                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
                {name: 'document', items: ['Source']}
            ],
            toolbar: 'Full'
        });



    }


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_contratos = $("#tbl_contratos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registrocontratos/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        'columnDefs': [
            {
                "targets": 7,
                "className": "text-center"
            }],
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "tipo", "name": "tipo"},
            {"data": "numero", "name": "numero"},
            {"data": "anio", "name": "anio"},
            {"data": "fecha_inicio", "name": "fecha_inicio"},
            {"data": "fecha_fin", "name": "fecha_fin"},
            {"data": "personal", "name": "personal"},
            {"data": "id_contrato", "name": "id_contrato"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_contratos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_contrato + '" pk2="' + data.anio + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            //Formateamos la  fecha inicio
            var fecha_inicio = data.fecha_inicio;
            //split igual explode php
            var res_fecha_inicio = fecha_inicio.split("-");
            //recorremos el array por las posiciones
            var array_2_fecha_inicio = res_fecha_inicio[2].split(" ");
            var res_fecha = array_2_fecha_inicio[0] + '/' + res_fecha_inicio[1] + '/' + res_fecha_inicio[0];
            $('td', row).eq(4).html(res_fecha);

            //Formateamos la fecha fin
            var fecha_fin = data.fecha_fin;
            //split igual explode php
            var res_fecha_fin = fecha_fin.split("-");
            //recorremos el array por las posiciones
            var array_2_fecha_fin = res_fecha_fin[2].split(" ");
            var res_fecha = array_2_fecha_fin[0] + '/' + res_fecha_fin[1] + '/' + res_fecha_fin[0];
            $('td', row).eq(5).html(res_fecha);

            if (data.archivo) {
                var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/contratos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                $('td', row).eq(7).html(html2);
            } else {
                var html2 = "";
                $('td', row).eq(7).html(html2);
            }




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
                    $('#tbl_contratos').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //exito datos guardados
    $("#exito_contratos").dialog({
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
                    window.location.href = base_url + "registrocontratos";
                }
            }]
    });


    //Error encuesta ya registrada para esa asignatura
    $("#error_contrato_registrado").dialog({
        //
        closeOnEscape: true,
        close: function (event, ui) {

            if (event.originalEvent) {
                window.location.href = base_url + "registrocontratos/registro";
            }
            $(this).dialog('destroy');
        },
        //
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
                    window.location.href = base_url + "registrocontratos/registro";
                }
            }]
    });


    //Error encuesta ya registrada para esa asignatura
    $("#error_tipo_vacio").dialog({
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
                    window.location.href = base_url + "registrocontratos/registro";
                }
            }]
    });

    $("#error_pdf").dialog({
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
                    //window.location.href = base_url + "registrocontratos/registro";
                    $('#archivo_resolucion').val("");
                }
            }]
    });

    //Error encuesta ya registrada para esa asignatura
    $("#error_numero_vacio").dialog({
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
                    window.location.href = base_url + "registrocontratos/registro";
                }
            }]
    });


    //Formulario publicar
    $("#publicar").on("click", function () {

        var fecha_input = $("#input-fecha_inicio").val();
        //alert("La fecha actual es:" + fecha_actual);
        var fecha_actual_split = fecha_input.split("/");
        //alert(fecha_actual_res[2]);
        var anio = fecha_actual_split[2];

        var numero = $("#input-numero").val();
        var tipo = $("#input-tipo_contrato option:selected").val();

        if (tipo === '') {

            $("#error_tipo_vacio").dialog("open");
            CuriositySoundError();
            //alert("tipo vacio");

        } else if (numero === '') {

            $("#error_numero_vacio").dialog("open");
            CuriositySoundError();
            //alert("numero vacio");
        } else {

            if (id1 === '' && id2 === '') {
                $.ajax({
                    type: 'POST',
                    url: base_url + "registrocontratos/numeroContrato",
                    data: {numero: numero, tipo: tipo, anio: anio},
                    dataType: 'json',
                    success: function (response) {
                        //console.log(response.estado);
                        if (response.say === 'si') {
                            //console.log('Si');


                            $("#error_contrato_registrado").dialog("open");
                            CuriositySoundError();


                        } else {
                            //console.log('No');


                            //formaulrio grabar
                            frmx = $("#form_contratos");
                            //var datos = $("#form_mantenimientos").serialize();
                            //var datos = $("#form_docentes");
                            var frm = new FormData(document.getElementById("form_contratos"));
                            //datos += "&contenido=" + encodeURIComponent(editor.getData());
                            frm.append('perfil', editor_perfil.getData());

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

                                        $("#exito_contratos").dialog("open");
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
                            //fin grabar


                        }

                        $(".errorforms").remove();
                    }, complete: function () {
                        //$("#form_curriculas").dialog("open");
                        //alert('Estado:' + estado);

                    }
                });
            } else {
                //formaulrio grabar
                frmx = $("#form_contratos");
                //var datos = $("#form_mantenimientos").serialize();
                //var datos = $("#form_docentes");
                var frm = new FormData(document.getElementById("form_contratos"));
                //datos += "&contenido=" + encodeURIComponent(editor.getData());
                frm.append('perfil', editor_perfil.getData());

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

                            $("#exito_contratos").dialog("open");
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
                //fin grabar
            }

        }


        //console.log(xsmart);

    });


    //Validar solo numeros
    $('#input-numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    $('#archivo_resolucion').on('change', function () {
        //alert($('#archivo_resolucion').val());
        var file_pdf = $('#archivo_resolucion').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registrocontratos/verificapdf",
            data: {file_pdf: file_pdf},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    $("#error_pdf").dialog("open");
                    CuriositySoundError();

                }
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });
    });

    $('#input-personal').select2({
        dropdownParent: $('#form_contratos')
    });

});



//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();
        var anio = $('input:radio[name=selrow]:checked').attr('pk2');

        //alert(xsmart);

        window.location.href = base_url + "registrocontratos/registro/" + xsmart + "/" + anio;

    } else {
        errordialogtablecuriosity();
    }

}


function eliminar() {

    if ($(".selrow").is(':checked')) {
        //var xsmart = $('input:radio[name=selrow]:checked').val();

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
                            url: base_url + "registrocontratos/eliminar",
                            type: 'POST',
                            data: {"id": xsmart, "id2": ano_eje},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_contratos').dataTable().fnDraw();
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


function concatenacionNombre() {
    //console.log("Hola mundo");
    var tipo_contrato = $("#input-tipo_contrato option:selected").text();
    var codigo_tipo = $("#input-tipo_contrato option:selected").val();
    var codigo_numero = $("#input-numero").val();
    var numero_contrato = $("#input-numero").val();

    var anio = $("#input-fecha_inicio").val();
    var res_anio = anio.split("/");

    var codigo_anio = res_anio[2];

    //console.log(res_anio[2]);

    $.ajax({
        type: 'POST',
        url: base_url + "registrocontratos/numeroContrato",
        data: {numero: codigo_numero, tipo: codigo_tipo, anio: codigo_anio},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {
                //console.log('Si');


                $("#error_contrato_registrado").dialog("open");
                CuriositySoundError();


            } else {

                var numero_digitos = numero_contrato.length;
                console.log(numero_digitos);
                if (tipo_contrato !== "SELECCIONE...") {
                    if (numero_digitos === 1) {
                        $("#input-contrato").val(tipo_contrato + " N° " + "000" + numero_contrato + "-" + res_anio[2] + "-" + xAbrevIns);
                    } else if (numero_digitos === 2) {
                        $("#input-contrato").val(tipo_contrato + " N° " + "00" + numero_contrato + "-" + res_anio[2] + "-" + xAbrevIns);
                    } else if (numero_digitos === 3) {
                        $("#input-contrato").val(tipo_contrato + " N° " + "0" + numero_contrato + "-" + res_anio[2] + "-" + xAbrevIns);
                    } else if (numero_digitos === 4) {
                        $("#input-contrato").val(tipo_contrato + " N° " + numero_contrato + "-" + res_anio[2] + "-" + xAbrevIns);
                    }
                } else {
                    $("#error_tipo_vacio").dialog("open");
                    CuriositySoundError();
                }

                if (id1 === '' && id2 === '') {
                    var fecha_input = $("#input-fecha_inicio").val();
                    //alert("La fecha actual es:" + fecha_input);
                    var fecha_actual_split = fecha_input.split("/");
                    //alert(fecha_actual_res[2]);
                    var anio = fecha_actual_split[2];

                    //console.log('Llega comision organizadora - año: ' + anio);
                    //
                    $.ajax({
                        type: 'POST',
                        url: base_url + "registrocontratos/getContratos",
                        data: {anio: anio},
                        dataType: 'json',
                        success: function (response) {
                            //console.log(response.estado);
                            if (response.say === 'si') {

                                //alert(response.pk_aumenta);

                                var codigo = response.codigo;

                                //alert(codigo);

                                $("#input-codigo").val(codigo);
                                $("#input-anio").val(anio);

                            }

                            $(".errorforms").remove();
                        }, complete: function () {
                            //$("#form_curriculas").dialog("open");
                            //alert('Estado:' + estado);

                        }
                    });
                }

            }

            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_curriculas").dialog("open");
            //alert('Estado:' + estado);

        }
    });

}






