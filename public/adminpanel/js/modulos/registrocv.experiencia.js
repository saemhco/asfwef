$(document).ready(function () {

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
    //

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_experiencia = $("#tbl_experiencia").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registrocv/datatableExperiencia", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "nombre_tipo", "name": "tipo.nombres" },
            { "data": "cargo", "name": "experiencia.cargo" },
            { "data": "institucion", "name": "experiencia.institucion" },
            { "data": "fecha_inicio", "name": "experiencia.fecha_inicio" },
            { "data": "fecha_fin", "name": "experiencia.fecha_fin" },
            { "data": "archivo", "name": "experiencia.archivo" },
            { "data": "estado", "name": "experiencia.estado" }],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_experiencia'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var fecha_inicio = data.fecha_inicio;
            if (fecha_inicio !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_inicio.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(4).html(fecha_ini_result2);
            }

            var fecha_fin = data.fecha_fin;
            if (fecha_fin !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_fin.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(5).html(fecha_ini_result2);
            }

            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/publico/experiencia/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";

            $('td', row).eq(6).html(html2);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X' || data.estado === 'I') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(7).html(html_estado);
        }
    }
    );




    $("#form_experiencia").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Experiencia</h4></div>",
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
                $(".errorforms").remove();

                if ($("#file-archivo")[0].files.length > 0) {


                    $sizeFile = $('#file-archivo')[0].files[0].size;
                    if ($sizeFile <= 1000000) {
                        //console.log("es menor a 1MB");
                        frmx = $("#form_experiencia");
                        //var frm = new FormData(this);
                        var frm = new FormData(document.getElementById("form_experiencia"));
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
                                    $('#tbl_experiencia').dataTable().fnDraw();
                                    bootbox.alert("<strong>Se registró correctamente</strong>");
                                    $("#form_experiencia").dialog("close");
                                } else {
                                    if (result.say === "falta") {
                                        var val = '<div class="text-danger errorforms">El campo archivo es requerido</div>';
                                        $("#input-archivo").after(val);
                                    } else {
                                        if (result.say === "no_formato") {
                                            var val = '<div class="text-danger errorforms">Subir archivo en formato .pdf/.jpg/.jpeg</div>';
                                            $("#input-archivo").after(val);
                                        } else {
                                            console.log("llegamos a la disco");
                                            $(".errorforms").remove();

                                            $.each(result, function (i, val) {
                                                $("#input-" + i).focus();
                                                $("#input-" + i).after(val);
                                            });
                                        }
                                    }
                                }
                            }
                        });

                    }
                } else {
                    //console.log("El archivo no debe ser mayor a 1MB");
                    var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
                    $("#input-archivo").after(val);
                }

            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });





    $("#input-fecha_fin").change(function () {


        var f_i = $("#input-fecha_inicio").val().split("/");
        var f_i_1 = f_i[2] + '-' + f_i[1] + '-' + f_i[0] + ' ' + '00:00:00';
        var fecha_inicio = f_i_1;
        //console.log(fecha_inicio);


        var f_f = $("#input-fecha_fin").val().split("/");
        var f_f_1 = f_f[2] + '-' + f_f[1] + '-' + f_f[0] + ' ' + '00:00:00';
        var fecha_fin = f_f_1;
        //console.log(fecha_fin);


        var dias = moment(fecha_fin).diff(moment(fecha_inicio), 'days');
        var tiempo = (dias / 30).toFixed(2);
        //console.log("Tiempo:" + tiempo);
        $("#input-tiempo").val(tiempo + " meses");




    });



    //reportes
    $("#form_reportes_xls").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i>Exportar </h4></div>",
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
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

});


function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $("#form_experiencia")[0].reset();
    $(".form_experiencia").remove();
    $("#input-file").attr("value", "");
    $("#input-estado").prop("checked", true);
    $("#input-codigo").val("");
    CKEDITOR.instances['input-funciones'].setData('');

    //    $.ajax({
    //        type: 'POST',
    //        url: base_url + "registrocv/getNuevoExperiencia",
    //        dataType: 'json',
    //        success: function (response) {
    //            //console.log(response.estado);
    //            if (response.say === 'si') {
    //
    //                $("#input-codigo").attr('value', response.codigo);
    //
    //            }
    //
    //            $(".errorforms").remove();
    //        }, complete: function () {
    //            $("#form_experiencia").dialog("open");
    //        }
    //    });
    $("#form_experiencia").dialog("open");
}

function editar() {
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        $(".form_experiencia").remove();
        $("#form_experiencia")[0].reset();
        $("#input-file").attr("value", "");
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registrocv/getAjaxPublicoExperiencia",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);
                    if (i === 'funciones') {
                        CKEDITOR.instances['input-funciones'].setData(val);
                    }

                    if (i === "fecha_inicio") {
                        //formateamos la fecha de inicio
                        var f_i = $("#input-fecha_inicio").val();
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
                        //formateamos la fecha de inicio
                        var f_i = $("#input-fecha_fin").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_ff = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_fin").val(result_ff);
                    }




                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {

                            var valor = '<div class="alert alert-warning fade in form_experiencia"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#input-archivo").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_experiencia">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/experiencia/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#input-archivo").after(valor);
                        }

                        $("#input-file").attr("value", val);
                    }



                });


                //console.log(response.fecha_inicio);

                var dias = moment(response.fecha_fin).diff(moment(response.fecha_inicio), 'days');
                var tiempo = (dias / 30).toFixed(2);

                $("#input-tiempo").val(tiempo + " meses");


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_experiencia").dialog("open");
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
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                },
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "registrocv/eliminarPublicoExperiencia",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_experiencia').dataTable().fnDraw();
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

function exportar() {
    $("#form_reportes_xls").dialog("open");
}


function reporte_registrocv_experiencia_xls() {
    window.open(base_url + "exportar/reporteregistrocvexperiencia");
}
