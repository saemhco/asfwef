$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_formacion = $("#tbl_formacion").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registrocv/datatableFormacion", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "nombre_grado", "name": "grado.nombres" },
            { "data": "nombre", "name": "formacion.nombre" },
            { "data": "fecha_grado", "name": "formacion.fecha_grado" },
            { "data": "archivo", "name": "formacion.archivo" },
            { "data": "estado", "name": "formacion.estado" }],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_formacion'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

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

            //ficha
            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/publico/formacion/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(4).html(html2);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X' || data.estado === 'I') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);


        }
    }
    );




    $("#form_formacion").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Formación Académica</h4></div>",
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

                //alert( $('#file-archivo')[0].files[0].size);
                if ($("#file-archivo")[0].files.length > 0){

                    $sizeFile = $('#file-archivo')[0].files[0].size;
                    if ($sizeFile <= 1000000) {
                        //console.log("es menor a 1MB");
                        
                    frmx = $("#form_formacion");
    
                    var frm = new FormData(document.getElementById("form_formacion"));
    
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
                                $('#tbl_formacion').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_formacion").dialog("close");
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


    // $('#file-archivo').bind('change', function() {
    //     $(".errorforms").remove();
    //     $sizeFile = $('#file-archivo')[0].files[0].size;
    //     if ($sizeFile <= 1000000) {
    //         console.log("es menor a 1MB");
    //     } else {
    //         var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
    //         $("#input-archivo").after(val);
    //     }
    //   });

});



function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $("#form_formacion")[0].reset();
    $(".form_formacion").remove();
    $("#input-file").attr("value", "");
    $("#input-estado").prop("checked", true);
    $("#input-codigo").val("");
    //CKEDITOR.instances['input-descripcion'].setData('');
    $("#form_formacion").dialog("open");
}

function editar() {
    if ($(".selrow").is(':checked')) {
        $(".form_formacion").remove();
        $("#form_formacion")[0].reset();
        $("#input-file").attr("value", "");
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registrocv/getAjaxPublicoFormacion",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);

                    if (i === "fecha_grado") {
                        //formateamos la fecha de inicio
                        var f_i = $("#input-fecha_grado").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_grado").val(result_fi);
                    }

                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {



                            var valor = '<div class="alert alert-warning fade in form_formacion"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#input-archivo").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_formacion">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/formacion/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#input-archivo").after(valor);
                        }

                        $("#input-file").attr("value", val);
                    }

                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_formacion").dialog("open");
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
                            url: base_url + "registrocv/eliminarPublicoFormacion",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_formacion').dataTable().fnDraw();
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


function reporte_registrocv_formacion_xls() {
    window.open(base_url + "exportar/reporteregistrocvformacion");
}
