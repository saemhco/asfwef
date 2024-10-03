$(document).ready(function () {

    if (id_ambiente_js !== 0) {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        tbl_ambientes_archivos = $("#tbl_ambientes_archivos").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "registroambientesweb/datatableAmbientesArchivos/" + id_ambiente_js, "type": "POST"},
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
                }],
            "order": [[1, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                {"data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false},
                {"data": "titular", "name": "ambientes_archivos.titular"},
                {"data": "fecha_hora", "name": "ambientes_archivos.fecha_hora"},
                {"data": "enlace", "name": "ambientes_archivos.enlace"},
                {"data": "archivo", "name": "ambientes_archivos.archivo"},
                {"data": "estado", "name": "ambientes_archivos.estado"}
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_ambientes_archivos'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {

                var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/ambientes_files/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                $('td', row).eq(4).html(archivo);

                //Formateamos la fecha
                var fecha_hora = data.fecha_hora;
                //split igual explode php
                var res_fecha_hora = fecha_hora.split("-");
                //recorremos el array por las posiciones
                //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
                var array_2_fecha_inicio = res_fecha_hora[2].split(" ");

                var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
                $('td', row).eq(2).html(res_fecha_hora);

                var html_estado = "";
                if (data.estado === 'A') {
                    html_estado = '<span class="label label-success">ACTIVO</span>';
                } else if (data.estado === 'X') {
                    html_estado = '<span class="label label-warning">INACTIVO</span>';
                }
                $('td', row).eq(5).html(html_estado);


            }
        });

    }



    $("#form_ambientes_archivos").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
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
                    //frm = $("#form_ambientes");  
                    frmx = $("#form_ambientes_archivos");
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
                            if (result.say === "yes")
                            {

                                $('#tbl_ambientes_archivos').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_ambientes_archivos").dialog("close");



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
    $("#form_ambientes .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar_ambientes_archivos() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $(".form_ambientes_archivos").remove();
    $("#input-id_ambiente_archivo").val("");
    $("#form_ambientes_archivos")[0].reset();
    $("#input-estado_ambientes_archivos").prop("checked", true);
    $("#form_ambientes_archivos").dialog("open");

}

function editar_ambientes_archivos() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $(".form_ambientes_archivos").remove();
        $.ajax({
            type: 'POST',
            url: base_url + "registroambientesweb/getAjaxAmbientesArchivos",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)

                    if (i === "id_ambiente_archivo") {
                        $("#input-id_ambiente_archivo").val(val);
                    }

                    $("#input-" + i + "_ambientes_archivos").val(val);


                    if (i === "estado") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-estado_ambientes_archivos").prop("checked", true);

                        }
                    }

                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {



                            var valor = '<div class="alert alert-warning fade in form_ambientes_archivos"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#ver_archivo").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_ambientes_archivos">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/ambientes_files/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#ver_archivo").after(valor);
                        }
                    }



                });

                //Formateamos fecha de nacimiento
                var f_i = $("#input-fecha_hora_ambientes_archivos").val();
                //console.log(f_i);
                //Split igual explode php
                var r_f_i = f_i.split(" ");
                //console.log(r_f_i[0]);
                var res_f_i = r_f_i[0].split("-");
                //console.log(res_f_i[0]);
                var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                //console.log(result_fi);
                $("#input-fecha_hora_ambientes_archivos").val(result_fi);

                //archivo_detalle


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_ambientes_archivos").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar_ambientes_archivos() {
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
                            url: base_url + "registroambientesweb/eliminarAmbientesArchivos",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_ambientes_archivos').dataTable().fnDraw();
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