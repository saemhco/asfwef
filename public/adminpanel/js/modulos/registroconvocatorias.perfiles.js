$(document).ready(function () {

    //formacion_academica
    var formacion_academica = CKEDITOR.replace('formacion_academica_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //experiencia_laboral_general
    var experiencia_laboral_general = CKEDITOR.replace('experiencia_laboral_general_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //experiencia_laboral_especifica
    var experiencia_laboral_especifica = CKEDITOR.replace('experiencia_laboral_especifica_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //competencias
    var competencias = CKEDITOR.replace('competencias_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //diplomados
    var diplomados = CKEDITOR.replace('diplomados_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //conocimientos_tecnicos
    var conocimientos_tecnicos = CKEDITOR.replace('conocimientos_tecnicos_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.conocimientos_tecnicos_ckeditor
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //condiciones_esenciales
    var condiciones_esenciales = CKEDITOR.replace('condiciones_esenciales_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });

    //funciones
    var funciones = CKEDITOR.replace('funciones_ckeditor', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbar_Basic: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
        ],
        toolbar_Full: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] },
            { name: 'document', items: ['Source'] }
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

    tbl_convocatoria_perfiles = $("#tbl_convocatoria_perfiles").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroconvocatorias/datatablesPerfiles/" + convocatoria, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [
            {
                "targets": 0,
                "className": "text-center"
            },
            {
                "targets": 3,
                "className": "text-center"
            }],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },
            { "data": "nombre", "name": "convocatorias_perfiles.nombre" },
            { "data": "nombre_corto", "name": "convocatorias_perfiles.nombre_corto" },
            { "data": "nombre_corto", "name": "convocatorias_perfiles.nombre_corto" },
            { "data": "convocatoria", "name": "convocatorias_perfiles.convocatoria" },
            { "data": "estado", "name": "convocatorias_perfiles.estado" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convocatoria_perfiles'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            if (tipoconvocatoria === "1") {
                var postulantes = "";
                var postulantes = "<a role='button' class='btn btn-xs btn-success' href='" + base_url + "registroconvocatorias/postulantes/" + data.codigo + "/" + data.convocatoria + "' >   <i class='fa fa-users' ></i></a>";
                $('td', row).eq(3).html(postulantes);
            } else if (tipoconvocatoria === "2") {
                var postulantes = "";
                var postulantes = "<a role='button' class='btn btn-xs btn-success' href='" + base_url + "registroconvocatorias/postulantes2/" + data.codigo + "/" + data.convocatoria + "' >   <i class='fa fa-users' ></i></a>";
                $('td', row).eq(3).html(postulantes);
            }else if (tipoconvocatoria === "3") {
                var postulantes = "";
                var postulantes = "<a role='button' class='btn btn-xs btn-success' href='" + base_url + "registroconvocatorias/postulantes2/" + data.codigo + "/" + data.convocatoria + "' >   <i class='fa fa-users' ></i></a>";
                $('td', row).eq(3).html(postulantes);
            }else if (tipoconvocatoria === "9") {
                var postulantes = "";
                var postulantes = "<a role='button' class='btn btn-xs btn-success' href='" + base_url + "registroconvocatorias/postulantes2/" + data.codigo + "/" + data.convocatoria + "' >   <i class='fa fa-users' ></i></a>";
                $('td', row).eq(3).html(postulantes);
            }




            var reportes = "";
            reportes = "<a role='button' title='Reporte PDF' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "reportes/postulantesconvocatorias/" + data.convocatoria + "/" + data.codigo + "' >   <i class='fa fa-file-pdf-o' ></i></a>\n\
            <a role='button' title='Reporte Excel' class='btn btn-xs btn-success' target='_BLANK' href='" + base_url + "exportar/postulantesconvocatorias/" + data.convocatoria + "/" + data.codigo + "' >   <i class='fa fa-file-excel-o' ></i></a>";
            $('td', row).eq(4).html(reportes);



            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);


        }
    });



    $("#form_convocatorias_perfiles").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Perfiles</h4></div>",
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

                frmx = $("#form_convocatorias_perfiles");
                var frm = new FormData(document.getElementById("form_convocatorias_perfiles"));
                frm.append('formacion_academica', formacion_academica.getData());
                frm.append('experiencia_laboral_general', experiencia_laboral_general.getData());
                frm.append('experiencia_laboral_especifica', experiencia_laboral_especifica.getData());
                frm.append('competencias', competencias.getData());
                frm.append('diplomados', diplomados.getData());
                frm.append('conocimientos_tecnicos', conocimientos_tecnicos.getData());
                frm.append('condiciones_esenciales', condiciones_esenciales.getData());
                frm.append('funciones', funciones.getData());

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

                            $('#tbl_convocatoria_perfiles').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_convocatorias_perfiles").dialog("close");



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

    //valida enter
    $("#form_convocatorias_perfiles .input").keypress(function (e) {
        if (e.which === 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar_perfiles() {
    $(".errorforms").hide();
    $("#form_convocatorias_perfiles")[0].reset();
    $(".form_convocatorias_perfiles").remove();

    CKEDITOR.instances['input-formacion_academica'].setData('');
    CKEDITOR.instances['input-experiencia_laboral_general'].setData('');
    CKEDITOR.instances['input-experiencia_laboral_especifica'].setData('');
    CKEDITOR.instances['input-competencias'].setData('');
    CKEDITOR.instances['input-diplomados'].setData('');
    CKEDITOR.instances['input-conocimientos_tecnicos'].setData('');
    CKEDITOR.instances['input-condiciones_esenciales'].setData('');
    CKEDITOR.instances['input-funciones'].setData('');


    //nuevo
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/getNuevoPerfiles",
        //data: {"personal": personal},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {
                //alert(response.codigo);

                $("#input-codigo_perfiles").attr('value', response.codigo);
                $("#input-hora_inicio").attr('value', '00:00:00');
                $("#input-hora_fin").attr('value', '00:00:00');
            }

            $(".errorforms").remove();
        }, complete: function () {

            $("#form_convocatorias_perfiles").dialog("open");
        }
    });
}



function editar_perfiles() {
    $("#form_convocatorias_perfiles")[0].reset();
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $(".form_convocatorias_perfiles").remove();
        $.ajax({
            type: 'POST',
            url: base_url + "registroconvocatorias/getAjaxPerfiles",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    if (i === "codigo") {
                        $("#input-" + i + "_perfiles").val(val);
                    }

                    if (i === "nombre") {
                        $("#input-" + i).val(val);
                    }

                    if (i === "nombre_corto") {
                        $("#input-" + i).val(val);
                    }

                    if (i === 'formacion_academica') {
                        CKEDITOR.instances['input-formacion_academica'].setData(val);
                    }

                    if (i === 'experiencia_laboral_general') {
                        CKEDITOR.instances['input-experiencia_laboral_general'].setData(val);
                    }

                    if (i === 'experiencia_laboral_especifica') {
                        CKEDITOR.instances['input-experiencia_laboral_especifica'].setData(val);
                    }

                    if (i === 'competencias') {
                        CKEDITOR.instances['input-competencias'].setData(val);
                    }


                    if (i === 'diplomados') {
                        CKEDITOR.instances['input-diplomados'].setData(val);
                    }

                    if (i === 'conocimientos_tecnicos') {
                        CKEDITOR.instances['input-conocimientos_tecnicos'].setData(val);
                    }

                    //condiciones_esenciales
                    if (i === 'condiciones_esenciales') {
                        CKEDITOR.instances['input-condiciones_esenciales'].setData(val);
                    }

                    //funciones
                    if (i === 'funciones') {
                        CKEDITOR.instances['input-funciones'].setData(val);
                    }

                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {



                            var valor = '<div class="alert alert-warning fade in form_convocatorias_perfiles"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#archivo_perfiles_modal").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_convocatorias_perfiles">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/convocatorias_perfiles/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#archivo_perfiles_modal").after(valor);
                        }
                    }



                    if (i === "imagen") {
                        //console.log("tiene imagen"+val);
                        if (val === "" || val === null) {

                            //console.log("Valor cuando esta vacio o es null:" + val);
                            var valor = '<div class="alert alert-warning fade in form_convocatorias_perfiles"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un imagen.</div>';
                            $("#imagen_perfiles_modal").after(valor);

                        } else {
                            var valor = '<div class="alert alert-success fade in form_convocatorias_perfiles">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/imagenes/convocatorias_perfiles/' + val + '" >  <i class="fa-fw fa fa-image"></i></a></div>';
                            $("#imagen_perfiles_modal").after(valor);

                        }
                    }


                    if (i === "fecha_inicio") {
                        //formateamos la fecha de inicio

                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        if (f_i !== null) {
                            var r_f_i = f_i.split(" ");
                            //console.log(r_f_i[0]);
                            var res_f_i = r_f_i[0].split("-");
                            //console.log(res_f_i[0]);
                            var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                            //console.log("Fecha de inicio:" + result_fi);
                            $("#input-fecha_inicio").val(result_fi);
                            //console.log("fecha_inicio:" + val);

                            var hora_inicio = r_f_i[1];
                            $("#input-hora_inicio").val(hora_inicio);
                        }

                    }

                    if (i === "fecha_fin") {
                        //formateamos la fecha de inicio

                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        if (f_i !== null) {
                            var r_f_i = f_i.split(" ");
                            //console.log(r_f_i[0]);
                            var res_f_i = r_f_i[0].split("-");
                            //console.log(res_f_i[0]);
                            var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                            //console.log("Fecha de inicio:" + result_fi);
                            $("#input-fecha_fin").val(result_fi);
                            //console.log("fecha_fin:" + val);

                            var hora_fin = r_f_i[1];
                            $("#input-hora_fin").val(hora_fin);
                        }

                    }

                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_convocatorias_perfiles").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}



function eliminar_perfiles() {
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
                            url: base_url + "registroconvocatorias/eliminarPerfiles",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_convocatoria_perfiles').dataTable().fnDraw();
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