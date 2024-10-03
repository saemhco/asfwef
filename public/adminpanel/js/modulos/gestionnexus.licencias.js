$(document).ready(function () {



    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_licencias = $("#tbl_licencias").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionnexus/datatableLicencias/" + iddocumento, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        "searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [
            {
                "targets": 0,
                "className": "text-center"
            }],
        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },
            { "data": "expediente_nro", "name": "expediente_nro" },
            { "data": "expediente_nro_folios", "name": "expediente_nro_folios" },
            { "data": "id_nro_doc", "name": "id_nro_doc" },
            { "data": "id_plaza", "name": "id_plaza" },
            { "data": "tipolicencia", "name": "tipolicencia" },
            { "data": "motivo", "name": "motivo" },
            { "data": "situacion", "name": "situacion" },
            { "data": "fecha_inicio", "name": "fecha_inicio" },
            { "data": "fecha_fin", "name": "fecha_fin" },
            { "data": "dias", "name": "dias" },
            { "data": "certificado", "name": "certificado" },
            { "data": "resolucion", "name": "resolucion" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_licencias'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success" style="color:white;">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning" style="color:white;">INACTIVO</span>';
            }
            $('td', row).eq(13).html(html_estado);


        }
    });




    $("#form_licencias").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "    <div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Licencias</h4></div>",
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
                //frm = $("#form_licencias");  
                frmx = $("#form_licencias");
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
                            console.log("save_padre");
                            $('#tbl_licencias').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_licencias").dialog("close");



                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();

                            $.each(result, function (i, val) {

                                if (i === "id_empresa") {
                                    $("#input-warning_empresas").after(val);
                                } else {
                                    $("#input-" + i).focus();
                                    $("#input-" + i).after(val);
                                }


                                if (i === "ciudad") {
                                    $("#input-empleo-ciudad").after(val);
                                }

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
    $("#form_licencias .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter

    $("#input-fecha_fin").change(function () {
        var fecha1 = $("#input-fecha_inicio").val();
        var fecha1_split = fecha1.split("/");
        var fecha_inicio = fecha1_split[2] + '-' + fecha1_split[1] + '-' + fecha1_split[0];

        var fecha2 = $("#input-fecha_fin").val();
        var fecha2_split = fecha2.split("/");
        var fecha_fin = fecha2_split[2] + '-' + fecha2_split[1] + '-' + fecha2_split[0];

        var mFecha1 = moment(fecha_inicio);
        var mFecha2 = moment(fecha_fin);

        var dias = mFecha2.diff(mFecha1, 'days');

        console.log(dias);

        if (isNaN(dias)) {
        } else {
            $("#input-dias").val(dias)
        }
    });

    $("#input-fecha_inicio").change(function () {
        var fecha1 = $("#input-fecha_inicio").val();
        var fecha1_split = fecha1.split("/");
        var fecha_inicio = fecha1_split[2] + '-' + fecha1_split[1] + '-' + fecha1_split[0];

        var fecha2 = $("#input-fecha_fin").val();
        var fecha2_split = fecha2.split("/");
        var fecha_fin = fecha2_split[2] + '-' + fecha2_split[1] + '-' + fecha2_split[0];

        var mFecha1 = moment(fecha_inicio);
        var mFecha2 = moment(fecha_fin);

        var dias = mFecha2.diff(mFecha1, 'days');

        console.log(dias);

        if (isNaN(dias)) {
        } else {
            $("#input-dias").val(dias)
        }
    });
});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#form_licencias")[0].reset();
    $(".form_licencias").remove();
    $("#form_licencias").dialog("open");
}

function editar() {
    $(".form_licencias").remove();
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "gestionnexus/getAjaxLicencias",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i).val(val);


                    if (i === "fecha_inicio") {
                        var f_i = val;
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
                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_fin").val(result_fi);
                    }




                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_licencias").dialog("open");
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
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "gestionnexus/eliminarLicencias",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_licencias').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


