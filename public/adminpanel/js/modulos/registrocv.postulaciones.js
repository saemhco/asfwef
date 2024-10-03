$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_postulaciones = $("#tbl_postulaciones").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registrocv/datatablepostulaciones", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columnDefs": [
            {"width": "70px", "targets": 1},
            {"width": "70px", "targets": 3},
            {"width": "250px", "targets": 4},
            {"width": "50px", "targets": 5, "className": "text-center"}
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha", "name": "convocatorias_publico.fecha"},
            {"data": "titulo", "name": "convocatorias.titulo"},
            {"data": "nombre_corto", "name": "convocatorias_perfiles.nombre_corto"},
            {"data": "nombre", "name": "convocatorias_perfiles.nombre"},
            {"data": "anexos", "name": "convocatorias_publico.anexos"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_postulaciones'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            //console.log(data.archivo);

            var fecha = data.fecha;
            if (fecha !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha.split(" ");
                //console.log(res_fecha_ini[0]);
                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);
                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(1).html(fecha_ini_result2);
            }

            var anexos = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/convocatorias_publico/" + data.anexos + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(5).html(anexos);




        }
    }
    );




    $("#form_convocatorias").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.6 : 0.6), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4 id='titulo_modal'></h4></div>",
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
                html: "<i class='fa fa-save'></i>&nbsp; Confirmar Postulación", "id": "graba",
                "class": "btn btn-info",
                click: function () {
                    frmx = $("#form_convocatorias");
                    var frm = new FormData(this);//Trae archivos del formulario

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
                                $('#tbl_postulaciones').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_convocatorias").dialog("close");
                            } else {
                                console.log("llegamos a la disco");
                                $(".errorforms").remove();

                                $.each(result, function (i, val) {
                                    //$("#input-" + i).focus();
                                    //$("#input-" + i).after(val);
                                    console.log(i);
                                    if (i === 'anexos') {
                                        $("#input-" + i).after(val);
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


});

function postular(codigo, convocatoria_perfiles_codigo, convocatorias_titular, convocatoria_perfiles_nombre_corto, convocatoria_perfiles_nombre, convocatorias_archivo) {
    //console.log("codigo:" + codigo + " - convocatoria:" + convocatoria);

    $("#form_convocatorias")[0].reset();

    $("#titulo_modal").text();


    var publico = $("#input-publico").val();


    $("#input-convocatorias_archivo").attr('href', base_url + "adminpanel/archivos/convocatorias/" + convocatorias_archivo);

    //var xsmart = $('input:radio[name=selrow]:checked').val();
    $.ajax({
        type: 'POST',
        url: base_url + "registrocv/verificarConvocatoria",
        data: {convocatoria: codigo, publico: publico},
        dataType: 'json',
        success: function (response) {
            if (response.say === 'yes') {
                bootbox.alert("<strong>Ud. ya postuló a esta convocatoria...</strong>");
            } else {

                $("#input-convocatorias_titular_text").text(convocatorias_titular);
                $("#input-convocatoria_perfiles_codigo_text").text(convocatoria_perfiles_nombre_corto);
                $("#input-convocatoria_perfiles_nombre_text").text(convocatoria_perfiles_nombre);

                $("#input-convocatorias_titular").val(convocatorias_titular);
                $("#input-convocatoria_perfiles_codigo").val(convocatoria_perfiles_nombre_corto);
                $("#input-convocatoria_perfiles_nombre").val(convocatoria_perfiles_nombre);




                $("#titulo_modal").text("Registro de Postulación - " + convocatoria_perfiles_nombre_corto + "-" + convocatoria_perfiles_nombre);

                $("#input-convocatoria").val(codigo);
                $("#input-perfil").val(convocatoria_perfiles_codigo);
                $("#form_convocatorias").dialog("open");
            }
        }
    });

}
