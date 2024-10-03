$(document).ready(function () {

    //alert(convocatoria);

    //funciones
    var funciones = CKEDITOR.replace('funciones_ckeditor', {
        removePlugins: 'elementspath',
        contentsCss: "body {font-size: 8px;}",
        readOnly: true,
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
        ],
        toolbar_Full: [
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_convocatoria_postulantes = $("#tbl_convocatoria_postulantes").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroconvocatorias/datatablePostulaantes/" + perfil_puesto + "/" + convocatoria, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": true,
        "order": [[1, "asc"]],
        "columnDefs": [
            { "targets": 2, "className": "text-center" },
            { "targets": 3, "className": "text-center" },
            { "targets": 4, "className": "text-center" },
            { "targets": 5, "className": "text-center" },
            { "targets": 6, "className": "text-center" },
            { "targets": 7, "className": "text-center" },
            { "targets": 8, "className": "text-center" },
            { "targets": 9, "className": "text-center" },
            { "targets": 10, "className": "text-center" },
            { "targets": 11, "className": "text-center" }
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },
            { "data": "fecha", "name": "fecha" },
            { "data": "fullname", "name": "fullname" },
            { "data": "nro_doc", "name": "nro_doc" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" }

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convocatoria_postulantes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            var datos_personales = "";
            datos_personales = "<button onclick='datos_personales(" + data.publico + ")' class='btn btn-xs btn-warning' ><i class='fa fa-user' ></i></button>";
            $('td', row).eq(4).html(datos_personales);

            var formacion_academica = "";
            formacion_academica = "<button onclick='formacion_academica(" + data.publico + ")' class='btn btn-xs btn-warning' ><i class='fa fa-graduation-cap' ></i></button>";
            $('td', row).eq(5).html(formacion_academica);

            var capacitaciones = "";
            capacitaciones = "<button onclick='capacitaciones(" + data.publico + ")' class='btn btn-xs btn-warning' ><i class='fa fa-book'></i></button>";
            $('td', row).eq(6).html(capacitaciones);

            var experiencia_laboral = "";
            experiencia_laboral = "<button onclick='experiencia(" + data.publico + ")' class='btn btn-xs btn-warning' ><i class='fa fa-briefcase'></i></button>\n\
            <button  class='btn btn-xs btn-success' onclick='experienciaExcel(" + data.publico + ")' ><i class='fa fa-file-excel-o'></i></button>";
            $('td', row).eq(7).html(experiencia_laboral);

            var anexos = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/convocatorias_publico/" + data.anexos + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(8).html(anexos);




            var reporte_resumen_ganador = "";
            reporte_resumen_ganador = "<button onclick='reporte_resumen(" + data.publico + ")' class='btn btn-xs btn-success' ><i class='fa fa-file-pdf-o'></i></button>";
            $('td', row).eq(9).html(reporte_resumen_ganador);


            var archivos = "";
            archivos = "<button onclick='archivos(" + data.publico + ")' class='btn btn-xs bg-color-magenta txt-color-white' ><i class='fa fa-file-archive-o'></i></button>\n\
            <button onclick='generarcv(" + data.publico + "," + convocatoria + ")' class='btn btn-xs bg-color-magenta txt-color-white' ><i class='fa fa-file-pdf-o'></i></button>";
            $('td', row).eq(10).html(archivos);


            var proceso = "";
            proceso = "<button onclick='proceso(" + data.publico + ")' class='btn btn-xs btn-primary' ><i class='fa fa-check-circle'></i></button>";
            $('td', row).eq(11).html(proceso);

        }
    });

    //valida enter
    $("#form_convocatorias_perfiles .input").keypress(function (e) {
        if (e.which === 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#form_funciones").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Funciones</h4></div>",
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
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });



    //datos personales
    $("#form_datos_personales").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.9 : 0.9), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Datos Personales</h4></div>",
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
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {

        }
    });


    $("#form_cv").dialog({
        autoOpen: false,
        //height: "auto",
        width: "300px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Resumen Curriculum Vitae</h4></div>",
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
            html: "<i class='fa fa-download'></i>&nbsp; Descargar", "id": "graba",
            "class": "btn btn-info",
            click: function () {

                var publico = $("#publico").val();

                if ($("#input-datos_personales").is(':checked')) {
                    //console.log('1');
                    var datos_personales = "A";
                } else {
                    //console.log('0');
                    var datos_personales = "I";
                }

                //var formacion = $("#input-formacion").val();
                if ($("#input-formacion").is(':checked')) {
                    //console.log('1');
                    var formacion = "A";
                } else {
                    //console.log('0');
                    var formacion = "I";
                }

                //var capacitaciones = $("#input-capacitaciones").val();
                if ($("#input-capacitaciones").is(':checked')) {
                    //console.log('1');
                    var capacitaciones = "A";
                } else {
                    //console.log('0');
                    var capacitaciones = "I";
                }

                if ($("#input-experiencia").is(':checked')) {
                    //console.log('1');
                    var experiencia = "A";

                } else {
                    //console.log('0');
                    var experiencia = "I";
                }

                //var experiencia = $("#input-experiencia").val();
                //console.log("Publico:"+publico);

                window.open(base_url + "reportes/reporteCurriculumVitaePublico/" + publico + "/" + datos_personales + "/" + formacion + "/" + capacitaciones + "/" + experiencia);
                $("#form_cv").dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });



    $("#form_archivos").dialog({
        autoOpen: false,
        //height: "auto",
        width: "250px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Descarga de archivos</h4></div>",
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
            html: "<i class='fa fa-download'></i>&nbsp; Descargar", "id": "graba",
            "class": "btn btn-primary",
            click: function () {

                var publico = $("#file_publico").val();

                if ($("#input-file_datos_personales").is(':checked')) {
                    //console.log('1');
                    var datos_personales = "A";
                    window.open(base_url + "registroconvocatorias/getArchivosDatosPersonales/" + publico + "/" + datos_personales);
                }

                if ($("#input-file_formacion").is(':checked')) {
                    //console.log('1');
                    var formacion = "A";
                    window.open(base_url + "registroconvocatorias/getArchivosFormacion/" + publico + "/" + formacion);
                }

                if ($("#input-file_capacitaciones").is(':checked')) {
                    //console.log('1');
                    var capacitaciones = "A";
                    window.open(base_url + "registroconvocatorias/getArchivosCapacitaciones/" + publico + "/" + capacitaciones);
                }

                if ($("#input-file_experiencia").is(':checked')) {
                    //console.log('1');
                    var experiencia = "A";
                    window.open(base_url + "registroconvocatorias/getArchivosExperiencia/" + publico + "/" + experiencia);
                }

            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#formcv").dialog({
        autoOpen: false,
        //height: "auto",
        width: "280px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Descarga de archivos</h4></div>",
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
            html: "<i class='fa fa-download'></i>&nbsp; Descargar todo",
            "class": "btn btn-primary",
            click: function () {
                //$(this).dialog("close");
                var id_publico = $("#file_publico").val();
                //window.open(base_url + "registroconvocatorias/getArchivos/" + publico);
                console.log(id_publico);
                
                $.ajax({
                    type: 'POST',
                    url: base_url + "registroconvocatorias/verificarcv",
                    data: { id_publico: id_publico, convocatoria:convocatoria },
                    dataType: 'json',
                    success: function (response) {
                        if (response.say == "yes") {
                            console.log("ya tiene cv");
                            window.open(base_url + "registroconvocatorias/getArchivos/" + id_publico+"/"+convocatoria);

                        } else if (response.say == "no") {
                            console.log("no tiene cv");

                            $("#alerta_cv").css("display", "block");



                        }
                    }
                });


            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#generar_cv").on("click", function () {
        //console.log(convocatoria);

        var id_publico = $("#file_publico").val();
        //console.log(id_publico);

        $.ajax({
            type: 'POST',
            url: base_url + "registroconvocatorias/generarcv",
            data: { id_publico: id_publico, convocatoria: convocatoria },
            dataType: 'json',
            success: function (response) {
                if (response.say == "yes") {
                    //console.log("cv generado correctamente");
                    $("#mensajecv1").css("display", "block");
                    $("#mensajecv2").css("display", "none");
                    $("#alerta_cv").css("display", "none");
                }
            }, complete: function () {
                //$("#form_autores").dialog("open");
            }
        });

    });


});

//formacion academica 
function formacion_academica(publico) {
    console.log("Llega codigo publico:" + publico);
    $("#modal_formacion").dialog("open");


    $('#tbl_formacion').DataTable().destroy();

    //datatable formacion
    $("#tbl_formacion").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroconvocatorias/datatablePublicoFormacion/" + publico, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "nombre_grado", "name": "grado.nombres" },
            { "data": "nombre", "name": "formacion.nombre" },
            { "data": "fecha_grado", "name": "formacion.fecha_grado" },
            { "data": "pais", "name": "formacion.pais" },
            { "data": "institucion", "name": "formacion.institucion" },
            { "data": "archivo", "name": "formacion.archivo" }
        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.

        },
        "createdRow": function (row, data, index) {

            var fecha_grado = data.fecha_grado;

            if (fecha_grado !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_grado.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(3).html(fecha_ini_result2);
            }

            var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/publico/formacion/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(6).html(archivo);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X' || data.estado === 'I') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(7).html(html_estado);


        }
    });
}

//capacitaciones
function capacitaciones(publico) {

    console.log("Llega codigo publico:" + publico);
    $("#modal_capacitaciones").dialog("open");

    $('#tbl_capacitaciones').DataTable().destroy();

    //datatable formacion
    $("#tbl_capacitaciones").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroconvocatorias/datatablePublicoCapacitaciones/" + publico, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //"pageLength": 5,
        //"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "nombre_capacitacion", "name": "capacitacion.nombres" },
            { "data": "nombre", "name": "capacitaciones.nombre" },
            { "data": "horas", "name": "capacitaciones.horas" },
            { "data": "creditos", "name": "capacitaciones.creditos" },
            { "data": "fecha_inicio", "name": "capacitaciones.fecha_inicio" },
            { "data": "fecha_fin", "name": "capacitaciones.fecha_fin" },
            { "data": "pais", "name": "capacitaciones.pais" },
            { "data": "institucion", "name": "capacitaciones.institucion" },
            { "data": "archivo", "name": "capacitaciones.archivo" },
        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.

        },
        "createdRow": function (row, data, index) {

            var fecha_inicio = data.fecha_inicio;
            if (fecha_inicio !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_inicio.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(5).html(fecha_ini_result2);
            }

            var fecha_fin = data.fecha_fin;
            if (fecha_fin !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_fin.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(6).html(fecha_ini_result2);
            }

            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/publico/capacitaciones/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(9).html(html2);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X' || data.estado === 'I') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(10).html(html_estado);

        }
    });
}

//capacitaciones
function experiencia(publico) {

    console.log("Llega codigo publico:" + publico);
    $("#modal_experiencia").dialog("open");
    $('#modal_experiencia').dialog('option', 'position', 'center');

    $('#tbl_experiencia').DataTable().destroy();

    //datatable formacion
    $("#tbl_experiencia").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroconvocatorias/datatableExperiencia/" + publico, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //"pageLength": 5,
        //"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "nombre_tipo", "name": "tipo.nombres" },
            { "data": "fecha_inicio", "name": "experiencia.fecha_inicio" },
            { "data": "fecha_fin", "name": "experiencia.fecha_fin" },
            { "data": "tiempo", "name": "experiencia.tiempo" },
            { "data": "cargo", "name": "experiencia.cargo" },
            { "data": "tipoinstitucion", "name": "tiposinstituciones.nombres" },
            { "data": "institucion", "name": "experiencia.institucion" },
            { "data": "funciones", "name": "experiencia.funciones" },
            { "data": "archivo", "name": "experiencia.archivo" },
            { "data": "estado", "name": "experiencia.estado" }
        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.

        },
        "createdRow": function (row, data, index) {

            var fecha_inicio = data.fecha_inicio;
            if (fecha_inicio !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_inicio.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(2).html(fecha_ini_result2);
            }

            var fecha_fin = data.fecha_fin;
            if (fecha_fin !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_fin.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(3).html(fecha_ini_result2);
            }

            //calculo del tiempo en experiencia
            var dias = moment(data.fecha_fin).diff(moment(data.fecha_inicio), 'days');
            //var tiempo = (dias / 30).toFixed(2);
            var tiempo = dias / 30;
            var tiempoFinal = (tiempo / 12).toFixed(2);
            //console.log("Tiempo:" + tiempo);

            var tiempo_val = "";
            tiempo_val = tiempoFinal;
            $('td', row).eq(4).html(tiempo_val);

            var funciones = "";
            funciones = "<button onclick='funciones(" + data.publico + ")' class='btn btn-xs btn-warning' ><i class='fa fa-files-o'></i></button>";
            $('td', row).eq(8).html(funciones);

            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/publico/experiencia/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(9).html(html2);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X' || data.estado === 'I') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(10).html(html_estado);

        }
    });
}



function proceso(publico) {
    $(".errorforms").hide();
    $("#form_proceso")[0].reset();
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/getResultadosConvocatorias",
        data: { publico: publico, convocatoria:convocatoria },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {



                $("#input-" + i).val(val);

                if (i == "chk_cv") {
                    if (val == '1') {
                        $("#input-" + i).prop("checked", true);
                    }
                }

                if (i == "chk_entrevista") {
                    if (val == '1') {
                        $("#input-" + i).prop("checked", true);
                    }
                }

                if (i == "chk_examen") {
                    if (val == '1') {
                        $("#input-" + i).prop("checked", true);
                    }
                }



            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#input-publico").val(publico);
            $("#form_proceso").dialog("open");
        }
    });
}

//modal formacion
$("#modal_formacion").dialog({
    position: { my: 'top', at: 'top+50' },
    autoOpen: false,
    width: $(window).width() * (($(window).width() > 1024) ? 0.9 : 0.9), // overcomes width:'auto' and maxWidth bug
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i>  Registro de Formación Académica</h4></div>",
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
        "class": "btn btn-primary",
        click: function () {
            $(this).dialog("close");
        }
    }],
    close: function () {
        //$('#tbl_formacion').DataTable().clear().destroy();
        $("#modal_formacion").dialog("close");
    }
});


//modal capacitaciones
$("#modal_capacitaciones").dialog({
    position: { my: 'top', at: 'top+50' },
    autoOpen: false,
    width: $(window).width() * (($(window).width() > 1024) ? 0.9 : 0.9), // overcomes width:'auto' and maxWidth bug
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i>  Registro de Capacitaciones</h4></div>",
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
        "class": "btn btn-primary",
        click: function () {
            $(this).dialog("close");
        }
    }],
    close: function () {
        //$('#tbl_formacion').DataTable().clear().destroy();
        $("#modal_capacitaciones").dialog("close");
    }
});


//modal capacitaciones
$("#modal_experiencia").dialog({
    position: { my: 'top', at: 'top+50' },
    autoOpen: false,
    width: $(window).width() * (($(window).width() > 1024) ? 0.9 : 0.9), // overcomes width:'auto' and maxWidth bug
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i>  Registro de Experiencia</h4></div>",
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
        "class": "btn btn-primary",
        click: function () {
            $(this).dialog("close");
        }
    }],
    close: function () {
        //$('#tbl_formacion').DataTable().clear().destroy();
        $("#modal_experiencia").dialog("close");
    }
});


//modal proceso
$("#form_proceso").dialog({
    autoOpen: false,
    width: $(window).width() * (($(window).width() > 1024) ? 0.3 : 0.3),
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Acciones</h4></div>",
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

            frm = $("#form_proceso");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (msg) {
                    var result = msg;
                    if (result.say === "yes") {
                        // $("#modalnew").modal("hide");
                        $('#tbl_atenciones').dataTable().fnDraw();
                        bootbox.alert("<strong>Se registró correctamente</strong>");
                        $("#form_proceso").dialog("close");
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

//funciones
function funciones(publico) {
    //console.log("Publico-Funciones:"+publico);
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/getExperienciaFunciones",
        data: { id: publico },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                $("#input-" + i).val(val);
                if (i === 'funciones') {

                    CKEDITOR.instances['input-funciones'].setData(val);
                }
            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#form_funciones").dialog("open");
        }
    });
}

function datos_personales(publico) {
    $(".error_foto").remove();
    $(".form_datos_personales").remove();
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/getPublicoDatos",
        data: { id: publico },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {


                $("#input-" + i).val(val);

                if (i === "fecha_nacimiento") {
                    //formateamos la fecha de inicio
                    var f_i = val;
                    //console.log(f_i);
                    //Split igual explode php
                    var r_f_i = f_i.split(" ");
                    //console.log(r_f_i[0]);
                    var res_f_i = r_f_i[0].split("-");
                    //console.log(res_f_i[0]);
                    var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                    //console.log("Fecha de inicio:" + result_fi);
                    $("#input-fecha_nacimiento").val(result_fi);
                }

                if (i === "discapacitado") {
                    if (val === "1") {
                        $("#input-" + i).prop("checked", true);
                    }
                }

                if (i === "foto") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {
                        $("#imagen_publico").append("<div class='alert alert-warning fade in error_foto'><i class='fa-fw fa fa-warning'></i><strong>No ha subido un archivo...</div>");

                    } else {

                        $("#imagen_publico").append("<img class='img-responsive error_foto' src='" + base_url + 'adminpanel/imagenes/publico/' + val + "' error='this.onerror=null;this.src='';'></img>");

                    }
                }

                if (i === "discapacitado_archivo") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {

                        var valor = '<div class="alert alert-warning fade in form_datos_personales"><i class="fa-fw fa fa-warning"></i>No ha subido un archivo...</div>';
                        $("#input-discapacitado_archivo").after(valor);

                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos_personales">Click aqui para ver el archivo<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-discapacitado_archivo").after(valor);
                    }
                }

                if (i === "archivo") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {

                        var valor = '<div class="alert alert-warning fade in form_datos_personales"><i class="fa-fw fa fa-warning"></i>No ha subido un archivo...</div>';
                        $("#input-archivo").after(valor);

                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos_personales">Click aqui para ver el archivo<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivo").after(valor);
                    }
                }

                if (i === "archivo_ruc") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {

                        var valor = '<div class="alert alert-warning fade in form_datos_personales"><i class="fa-fw fa fa-warning"></i>No ha subido un archivo...</div>';
                        $("#input-archivo_ruc").after(valor);

                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos_personales">Click aqui para ver el archivo<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivo_ruc").after(valor);
                    }
                }

                if (i === "archivo_cp") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {

                        var valor = '<div class="alert alert-warning fade in form_datos_personales"><i class="fa-fw fa fa-warning"></i>No ha subido un archivo...</div>';
                        $("#input-archivo_cp").after(valor);

                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos_personales">Click aqui para ver el archivo<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivo_cp").after(valor);
                    }
                }

                if (i === "archivo_dc") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {

                        var valor = '<div class="alert alert-warning fade in form_datos_personales"><i class="fa-fw fa fa-warning"></i>No ha subido un archivo...</div>';
                        $("#input-archivo_dc").after(valor);

                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos_personales">Click aqui para ver el archivo<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivo_dc").after(valor);
                    }
                }

            });

            var region = response.region;
            var provincia = response.provincia;
            var distrito = response.distrito;

            carga_provincia(region, provincia);
            carga_distrito(region, provincia, distrito);



            $(".errorforms").remove();
        }, complete: function () {
            $("#form_datos_personales").dialog("open");
        }
    });
}


//carga provincia
function carga_provincia(region, param) {

    $.post(base_url + "web/getProvincias", { pk: region }, function (response) {
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
        //console.log('Llega');

        $("#input-provincia").html(html);


    }, "json");

}

//carga distri
function carga_distrito(region, provincia, param) {

    //console.log("region:" + region);
    //console.log("provincia:" + provincia);
    //console.log("distrito:" + param);

    $.post(base_url + "web/getDistritos", { pk: region, idprov: provincia }, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';
        $.each(response, function (i, val) {
            if (param === 0) {
                html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
            } else {


                if (val.distrito === param) {

                    console.log("GAAAAAAAAAAAAAA");

                    html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                } else {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                }
            }

        });

        $("#input-distrito").html(html);
    }, "json");

}


function reporte_resumen(publico) {
    $("#form_cv")[0].reset();
    $("#publico").val(publico);
    $("#form_cv").dialog("open");
}


function archivos(id_publico) {
    $("#form_archivos")[0].reset();
    $("#file_publico").val(id_publico);
    $("#form_archivos").dialog("open");
}

function generarcv(id_publico, convocatoria) {
    //console.log(convocatoria)
    $("#formcv")[0].reset();
    $("#file_publico").val(id_publico);
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/verificarcv",
        data: { id_publico: id_publico, convocatoria:convocatoria },
        dataType: 'json',
        success: function (response) {
            if (response.say == "yes") {
                //console.log("ya tiene cv");
                $("#mensajecv1").css("display", "block");
                $("#mensajecv2").css("display", "none");
            } else if (response.say == "no") {
                //console.log("no tiene cv");
                $("#mensajecv1").css("display", "none");
                $("#mensajecv2").css("display", "block");

            }
        }, complete: function () {
            $("#formcv").dialog("open");
        }
    });

}

function experienciaExcel(publico) {
    console.log("id_publico:" + publico)
    window.open(base_url + "exportar/exportarexperiencia/" + publico);

}
