$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_noticias_detalles = $("#tbl_noticias_detalles").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registronoticias/datatableDetalles/" + id_noticia, "type": "POST"},
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
            {"data": "imagen_detalle", "name": "not_detalle.imagen_detalle"},
            {"data": "titular_detalle", "name": "not_detalle.titular_detalle"},
            {"data": "fecha_hora_detalle", "name": "not_detalle.fecha_hora_detalle"},
            {"data": "enlace_detalle", "name": "not_detalle.enlace_detalle"},
            {"data": "estado_detalle", "name": "not_detalle.estado_detalle"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_noticias_detalles'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = "<img src='" + base_url + "adminpanel/imagenes/noticias_detalles/" + data.imagen_detalle + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html);

            //Formateamos la fecha
            var fecha_hora = data.fecha_hora_detalle;
            //split igual explode php
            var res_fecha_hora = fecha_hora.split("-");
            //recorremos el array por las posiciones
            //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
            var array_2_fecha_inicio = res_fecha_hora[2].split(" ");

            var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
            $('td', row).eq(3).html(res_fecha_hora);


            var html_estado = "";
            if (data.estado_detalle === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado_detalle === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);


        }
    });



    $("#form_noticias_detalles").dialog({
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
                    //frm = $("#form_noticias");  
                    frmx = $("#form_noticias_detalles");
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

                                $('#tbl_noticias_detalles').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_noticias_detalles").dialog("close");



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
    $("#form_noticias .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $("#input-id_noticia_detalle").val("");
    $("#form_noticias_detalles")[0].reset();
    $("#form_noticias_detalles").dialog("open");


    //fecha actual
    let date = new Date();

    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    if (month < 10) {
        //console.log(`${day}-0${month}-${year}`);
        $("#input-fecha_hora_detalle").val(`${day}/0${month}/${year}`);
    } else {
        //console.log(`${day}-${month}-${year}`);
        $("#input-fecha_hora_detalle").val(`${day}/${month}/${year}`);
    }
    $("#input-estado_detalle").prop("checked", true);

}
function editar() {

    $("#input-estado_detalle").prop("checked", false);

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registronoticias/getAjaxDetalles",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i).val(val);



                    if (i === "estado_detalle") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i).prop("checked", true);

                        }
                    }

                });

                //Formateamos fecha de nacimiento
                var f_i = $("#input-fecha_hora_detalle").val();
                //console.log(f_i);
                //Split igual explode php
                var r_f_i = f_i.split(" ");
                //console.log(r_f_i[0]);
                var res_f_i = r_f_i[0].split("-");
                //console.log(res_f_i[0]);
                var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                //console.log(result_fi);
                $("#input-fecha_hora_detalle").val(result_fi);

                //archivo_detalle
                $('#archivo_noticia_detalle').val("");

                //imagen_detalle
                $('#imagen_noticias_detalle').val("");

                //enlace_archivo
                $("#enlace_archivo").attr("href", base_url + "adminpanel/archivos/noticias_detalles/" + $("#input-archivo_detalle").val());





                $(".errorforms").remove();
            }, complete: function () {
                $("#form_noticias_detalles").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar()
{
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
                            url: base_url + "registronoticias/eliminarDetalles",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_noticias_detalles').dataTable().fnDraw();
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