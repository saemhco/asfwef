$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_documentos_archivos = $("#tbl_documentos_archivos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registrodocumentosgestion/datatableArchivos/" + id_documento, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [{ "targets": 3, "className": "text-center" }, { "targets": 4, "className": "text-center" }],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },
            { "data": "fecha_hora", "name": "public.tbl_web_documentos_archivos.fecha_hora" },
            { "data": "titulo", "name": "public.tbl_web_documentos_archivos.titulo" },
            { "data": "archivo", "name": "public.tbl_web_documentos_archivos.archivo" },
            { "data": "estado", "name": "public.tbl_web_documentos_archivos.estado" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_documentos_archivos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html3 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/documentos_archivos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(3).html(html3);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(4).html(html_estado);

        }
    });



    $("#form_documentos_archivos").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 500,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Archivos</h4></div>",
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
                //frm = $("#form_galerias");  
                frmx = $("#form_documentos_archivos");
                var frm = new FormData(this);

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

                            $('#tbl_documentos_archivos').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_documentos_archivos").dialog("close");



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
    $("#form_galerias .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregarArchivo() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $("#input-id_documento_archivo_archivo").val("");
    $("#form_documentos_archivos")[0].reset();
    $("#form_documentos_archivos").dialog("open");

    //fecha actual
    let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    if (month < 10) {
        //console.log(`${day}-0${month}-${year}`);
        $("#input-fecha_hora_archivo").val(`${day}/0${month}/${year}`);
    } else {
        //console.log(`${day}-${month}-${year}`);
        $("#input-fecha_hora_archivo").val(`${day}/${month}/${year}`);
    }

    $("#input-estado_detalle").prop("checked", true);

    $('#input-archivos-id_resolucion').val("");

    $('#input-archivos-id_resolucion').select2({
        dropdownParent: $('#form_documentos_archivos')
    });

}


function editarArchivo() {

    $(".form_documentos_archivos").hide();
    $('#input-archivos-id_resolucion').select2({
        dropdownParent: $('#form_documentos_archivos')
    });

    $("#input-estado_detalle").prop("checked", false);

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registrodocumentosgestion/getAjaxDocumentosArchivos",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i + "_archivo").val(val);


                    if (i === "id_resolucion") {

                        console.log(val);

                        // $('#input-id_tabla_computadoras_hidden').val(val);

                        $('#input-archivos-id_resolucion').val(val).trigger('change');


                    }


                    if (i === "visible") {

                        if (val === "1") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-visible_archivo").prop("checked", true);

                        }
                    }

                    if (i == "fecha_hora") {
                        var fecha_split = val;
                        var fecha_split_1 = fecha_split.split(" ");
                        var fecha_split_2 = fecha_split_1[0].split("-");
                        var fecha = fecha_split_2[2] + '/' + fecha_split_2[1] + '/' + fecha_split_2[0];
                        $("#input-fecha_hora_archivo").val(fecha);
                    }

                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {

                            var valor = '<div class="alert alert-warning fade in form_documentos_archivos errorforms"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#ver_archivo").after(valor);
                        } else {

                            var valor = '<div class="alert alert-success fade in form_documentos_archivos errorforms">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/documentos_archivos/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#ver_archivo").after(valor);
                        }
                    }



                });



                //$(".errorforms").remove();
            }, complete: function () {
                $("#form_documentos_archivos").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminarArchivo() {
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
                            url: base_url + "registrodocumentosgestion/eliminarDocumentosArchivos",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_documentos_archivos').dataTable().fnDraw();
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