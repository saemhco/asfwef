$(document).ready(function () {


    //alert("id1: " + id1 + "-" + "id2: " + id2);


    //alert(xAbrevIns);
    //CKeditor
    if (publica == "si") {

        //Visto
        var editor_visto = CKEDITOR.replace('visto_ckeditor', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbar_Basic: [

                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
                { name: 'document', items: ['Source'] }
            ],
            toolbar_Full: [
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
                { name: 'document', items: ['Source'] }
            ],
            toolbar: 'Full'
        });

        //Resuelve
        var editor_resuelve = CKEDITOR.replace('resuelve_ckeditor', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbar_Basic: [

                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
                { name: 'document', items: ['Source'] }
            ],
            toolbar_Full: [
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
                { name: 'document', items: ['Source'] }
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

    tbl_resoluciones = $("#tbl_resoluciones").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroresoluciones/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "numero", "name": "numero" },
            { "data": "anio", "name": "anio" },
            { "data": "titulo", "name": "titulo" },
            { "data": "fecha", "name": "fecha" },
            { "data": "archivo", "name": "archivo" },
            { "data": "estado", "name": "estado" }


        ],
        "columnDefs": [{
            "targets": 5,
            "data": "data.url",
            "render": function (data, type, row, meta) {

             
                    return "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";

                
            }
        }],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {
            //"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json",
            'search': 'asas' /*Empty to remove the label*/,
            "searchPlaceholder": "Ingrese el texto a buscar y presione enter ...",
            "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_resoluciones'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            //Formateamos la fecha
            var fecha_hora = data.fecha;
            //split igual explode php
            var res_fecha_hora = fecha_hora.split("-");
            //recorremos el array por las posiciones
            var array_2_fecha_inicio = res_fecha_hora[2].split(" ");
            var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
            $('td', row).eq(4).html(res_fecha_hora);

            //Icono descarga

            console.log(data.tipo);

            if(data.archivo){
                if (data.tipo === 1) {

                    var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    $('td', row).eq(5).html(html2);
                } else if (data.tipo === 2) {
                    var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    $('td', row).eq(5).html(html2);
                } else if (data.tipo === 3) {
                    var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    $('td', row).eq(5).html(html2);
                }
    
            }








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
                    $('#tbl_resoluciones').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //exito datos guardados
    $("#exito_resoluciones").dialog({
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
                window.location.href = base_url + "registroresoluciones";
            }
        }]
    });


    //Error encuesta ya registrada para esa asignatura
    $("#error_resolucion_registrada").dialog({
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
                //window.location.href = base_url + "registroresoluciones/registro";
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
                //window.location.href = base_url + "registroresoluciones/registro";
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
                //window.location.href = base_url + "registroresoluciones/registro";
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
                //window.location.href = base_url + "registroresoluciones/registro";
            }
        }]
    });








    //Formulario publicar
    $("#publicar").on("click", function () {

        var fecha_input = $("#input-fecha").val();
        //alert("La fecha actual es:" + fecha_actual);
        var fecha_actual_split = fecha_input.split("/");
        //alert(fecha_actual_res[2]);
        var anio = fecha_actual_split[2];





        var numero = $("#input-numero").val();
        var tipo = $("#input-tipo_resolucion option:selected").val();

        if (tipo === '') {

            $("#error_tipo_vacio").dialog("open");
            CuriositySoundError();
            //alert("tipo vacio");

            // var val = '<div class="text-danger errorforms">El campo tipo es requerido</div>';
            // $("#input-tipo_resolucion").after(val);

        } else if (numero === '') {

            $("#error_numero_vacio").dialog("open");
            CuriositySoundError();
            //alert("numero vacio");
        } else {

            if (id === '') {
                $.ajax({
                    type: 'POST',
                    url: base_url + "registroresoluciones/numeroResolucion",
                    data: { numero: numero, tipo: tipo, anio: anio },
                    dataType: 'json',
                    success: function (response) {
                        //console.log(response.estado);
                        if (response.say === 'si') {
                            //console.log('Si');


                            $("#error_resolucion_registrada").dialog("open");
                            CuriositySoundError();


                        } else {

                            frmx = $("#form_resoluciones");
                            var frm = new FormData(document.getElementById("form_resoluciones"));
                            frm.append('visto', editor_visto.getData());
                            frm.append('resuelve', editor_resuelve.getData());

                            $.ajax({
                                url: frmx.attr("action"),
                                type: 'POST',
                                data: frm,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (msg) {
                                    var result = msg;
                                    if (result.say === "yes") {

                                        $("#exito_resoluciones").dialog("open");


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

                        $(".errorforms").remove();
                    }, complete: function () {


                    }
                });
            } else {

                frmx = $("#form_resoluciones");
                var frm = new FormData(document.getElementById("form_resoluciones"));
                frm.append('visto', editor_visto.getData());
                frm.append('resuelve', editor_resuelve.getData());

                $.ajax({
                    url: frmx.attr("action"),
                    type: 'POST',
                    data: frm,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {

                            $("#exito_resoluciones").dialog("open");
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
            }

        }


    });



    //Validar solo numeros
    $('#input-numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });



    //


    $('#archivo_resolucion').on('change', function () {
        //alert($('#archivo_resolucion').val());
        var file_pdf = $('#archivo_resolucion').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registroresoluciones/verificapdf",
            data: { file_pdf: file_pdf },
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



    var fecha_inicio = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio").val(fecha_inicio);

    var fecha_fin = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin").val(fecha_fin);

    $("#input-buscar").on("click", function () {
        console.log("Testing by @KeMack");
        $(".errorforms").remove();
        if ($("#input-fecha_inicio").val() === "" || $("#input-fecha_fin").val() === "") {
            //console.log("Entra Aqui");
            if ($("#input-fecha_inicio").val() === "") {
                var val = '<div class="text-danger errorforms">Ingresar fecha desde</div>';
                $("#input-fecha_inicio").after(val);
            }
            if ($("#input-fecha_fin").val() === "") {
                var val = '<div class="text-danger errorforms">Ingresar fecha hasta</div>';
                $("#input-fecha_fin").after(val);
            }


        } else {
            var fecha_inicio1 = $("#input-fecha_inicio").val();
            fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
            console.log("fecha_incio:" + fecha_inicio);
            var fecha_fin1 = $("#input-fecha_fin").val();
            fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
            console.log("fecha_fin:" + fecha_fin);

            var tipo = $("#input-tipo_resolucion").val();

            var responsiveHelper_dt_basic = undefined;
            $('#tbl_resoluciones').DataTable().destroy();
            tbl_resoluciones = $("#tbl_resoluciones").DataTable({
                "stateSave": true,
                "ajax": { "url": base_url + "registroresoluciones/datatable/" + fecha_inicio + "/" + fecha_fin + "/" + tipo, "type": "POST" },
                "processing": false,
                "serverSide": true,
                "order": [[2, "asc"], [3, "asc"]],
                "columns": [
                    //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                    { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                    { "data": "numero", "name": "numero" },
                    { "data": "anio", "name": "anio" },
                    { "data": "titulo", "name": "titulo" },
                    { "data": "fecha", "name": "fecha" },
                    { "data": "archivo", "name": "archivo" },
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
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_resoluciones'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic.respond();
                }, "createdRow": function (row, data, index) {

                    var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_resolucion + '" pk2="' + data.anio + '" ><i></i> </label></center>';
                    $('td', row).eq(0).html(html);

                    //Formateamos la fecha
                    var fecha_hora = data.fecha;
                    //split igual explode php
                    var res_fecha_hora = fecha_hora.split("-");
                    //recorremos el array por las posiciones
                    var array_2_fecha_inicio = res_fecha_hora[2].split(" ");
                    var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
                    $('td', row).eq(4).html(res_fecha_hora);

                    //Icono descarga

                    console.log(data.tipo);

                    if (data.tipo === 1) {

                        var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                        $('td', row).eq(5).html(html2);
                    } else if (data.tipo === 2) {
                        var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                        $('td', row).eq(5).html(html2);
                    } else if (data.tipo === 3) {
                        var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                        $('td', row).eq(5).html(html2);
                    }







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
                            $('#tbl_resoluciones').dataTable().fnFilter(this.value);
                        }
                    });
                }
            });
        }
    });


    $("#input-numero").change(function () {

        var fecha_input = $("#input-fecha").val();
        var fecha_actual_split = fecha_input.split("/");
        var anio = fecha_actual_split[2];
        var numero = $("#input-numero").val();
        var tipo = $("#input-tipo_resolucion option:selected").val();



        $.ajax({
            type: 'POST',
            url: base_url + "registroresoluciones/numeroResolucion",
            data: { numero: numero, tipo: tipo, anio: anio },
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {
                    //console.log('Si');


                    $("#error_resolucion_registrada").dialog("open");
                    CuriositySoundError();
                    $("#publicar").attr("disabled", true);
                    // var val = '<div class="text-danger errorforms">El monto debe ser mayor</div>';
                    // $("#input_monto").after(val);


                } else if (response.say === 'no') {
                    $("#publicar").attr("disabled", false);
                }

                $(".errorforms").remove();
            }, complete: function () {


            }
        });
    });


    $('#input-id_documento').select2();




});


function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_resolucion").val("");
    $("#form_resoluciones")[0].reset();
    $("#form_resoluciones").dialog("open");
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();


        //alert(xsmart);

        window.location.href = base_url + "registroresoluciones/registro/" + xsmart;



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
                            url: base_url + "registroresoluciones/eliminar",
                            type: 'POST',
                            data: { "id": xsmart, "id2": ano_eje },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_resoluciones').dataTable().fnDraw();
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
    var tipo_resolucion = $("#input-tipo_resolucion option:selected").text();
    var numero_resolucion = $("#input-numero").val();


    var anio = $("#input-fecha").val();
    var res_anio = anio.split("/");

    //console.log(res_anio[2]);
    var numero_digitos = numero_resolucion.length;

    console.log(numero_digitos);





    if (tipo_resolucion === "COMISION ORGANIZADORA") {


        //
        if (xAbrevIns === 'UNCA') {
            if (numero_digitos === 1) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + "000" + numero_resolucion + "-" + res_anio[2] + "/CO-UNCA");
            } else if (numero_digitos === 2) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + "00" + numero_resolucion + "-" + res_anio[2] + "/CO-UNCA");
            } else if (numero_digitos === 3) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + "0" + numero_resolucion + "-" + res_anio[2] + "/CO-UNCA");
            } else if (numero_digitos === 4) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + numero_resolucion + "-" + res_anio[2] + "/CO-UNCA");
            }

        } else if (xAbrevIns === 'UNAAA') {
            if (numero_digitos === 1) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + "000" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/CO");
            } else if (numero_digitos === 2) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + "00" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/CO");
            } else if (numero_digitos === 3) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + "0" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/CO");
            } else if (numero_digitos === 4) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE " + tipo_resolucion + " N° " + numero_resolucion + "-" + res_anio[2] + "-UNAAA/CO");
            }
        }






    } else if (tipo_resolucion === "PRESIDENCIAL") {
        //presidencial
        if (xAbrevIns === 'UNCA') {
            if (numero_digitos === 1) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN " + tipo_resolucion + " N° " + "00" + numero_resolucion + "-" + res_anio[2] + "/P-UNCA");
            } else if (numero_digitos === 2) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN " + tipo_resolucion + " N° " + "0" + numero_resolucion + "-" + res_anio[2] + "/P-UNCA");
            } else if (numero_digitos === 3) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN " + tipo_resolucion + " N° " + numero_resolucion + "-" + res_anio[2] + "/P-UNCA");
            }
        } else if (xAbrevIns === 'UNAAA') {
            if (numero_digitos === 1) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN " + tipo_resolucion + " N° " + "00" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/P");
            } else if (numero_digitos === 2) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN " + tipo_resolucion + " N° " + "0" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/P");
            } else if (numero_digitos === 3) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN " + tipo_resolucion + " N° " + numero_resolucion + "-" + res_anio[2] + "-UNAAA/P");
            }
        }





    } else if (tipo_resolucion === "ADMINISTRACION") {

        if (xAbrevIns === 'UNCA') {
            if (numero_digitos === 1) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE LA DIRECCIÓN GENERAL DE " + tipo_resolucion + " N° " + "00" + numero_resolucion + "-" + res_anio[2] + "/DGA-UNCA");
            } else if (numero_digitos === 2) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE LA DIRECCIÓN GENERAL DE " + tipo_resolucion + " N° " + "0" + numero_resolucion + "-" + res_anio[2] + "/DGA-UNCA");
            } else if (numero_digitos === 3) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE LA DIRECCIÓN GENERAL DE " + tipo_resolucion + " N° " + numero_resolucion + "-" + res_anio[2] + "/DGA-UNCA");
            }

        } else if (xAbrevIns === 'UNAAA') {
            if (numero_digitos === 1) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE LA DIRECCIÓN GENERAL DE " + tipo_resolucion + " N° " + "00" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/DGA");
            } else if (numero_digitos === 2) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE LA DIRECCIÓN GENERAL DE " + tipo_resolucion + " N° " + "0" + numero_resolucion + "-" + res_anio[2] + "-UNAAA/DGA");
            } else if (numero_digitos === 3) {
                var nombre_resolucion = $("#input-titulo").val("RESOLUCIÓN DE LA DIRECCIÓN GENERAL DE " + tipo_resolucion + " N° " + numero_resolucion + "-" + res_anio[2] + "-UNAAA/DGA");
            }
        }




    }




}




