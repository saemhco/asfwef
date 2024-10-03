$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_dbu_solicitud_servicios = $("#tbl_dbu_solicitud_servicios").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionsolicitudes/datatableBienestaruniversitario", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha_hora", "name": "fecha_hora"},
            {"data": "titular", "name": "titular"},
            {"data": "asunto", "name": "asunto"},
            {"data": "archivo", "name": "archivo"},
            {"data": "estado", "name": "estado"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_dbu_solicitud_servicios'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var fecha_ini_r1 = data.fecha_hora.split(" ");
            //console.log(res_fecha_ini[0]);

            var fecha_ini_result1 = fecha_ini_r1[0].split("-");
            //console.log(fecha_ini_result1[2]);

            var hora_date = fecha_ini_r1[1].split("-");

            var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
            $('td', row).eq(1).html(fecha_ini_result2 + " - " + hora_date);


            var asunto = "";
            asunto = "<button onclick='asunto(" + data.id_solicitud_servicio +")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
            $('td', row).eq(3).html(asunto);


            var archivo = data.archivo;
            if (archivo !== null) {
                var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/solicitudes/alumnos/FILE-BU-" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                $('td', row).eq(4).html(archivo);
            }
            /*
            var html_estado = "";
            if (data.estado === '1') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);
            */
            var html_estado = "";
            if (data.estado === '1') {
                html_estado = '<span class="label label-warning">Pendiente</span>';
            } else if (data.estado === '2') {
                html_estado = '<span class="label label-success">Aprobado</span>';
            } else if (data.estado === '3') {
                html_estado = '<span class="label label-danger">Denegado</span>';
            }
            $('td', row).eq(5).html(html_estado);
            



        }
    }
    );




    $("#form_bienestaruniversitario").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Solicitudes</h4></div>",
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
                    frmx = $("#form_bienestaruniversitario");
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
                                $("#form_bienestaruniversitario").dialog("close");

                                bootbox.alert({
                                    message: "<strong>Se resgistro correctamente</strong>",
                                    callback: function () {
                                        //location.reload();
                                        $('#tbl_dbu_solicitud_servicios').dataTable().fnDraw();
                                    }
                                });

                            } else {
                                console.log("llegamos a la disco");
                                $(".errorforms").remove();

                                $.each(result, function (i, val) {
                                    $("#input_" + i).focus();
                                    $("#input_" + i).after(val);
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

//var ab = document.getElementById("myfile").value.replace('C:\\fakepath\\', '');
function agregar() {
    $("#form_bienestaruniversitario")[0].reset();
    $("#input_estado").prop("checked", true);

    var semestre = $("#semestre").val();
    var alumno = $("#alumno").val();

    $.ajax({
        type: 'POST',
        url: base_url + "gestionsolicitudes/getNewAlumnosSolicitudes",
        data: {semestre: semestre, alumno: alumno},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {
                //console.log(response.numero);

                $("#input_numero").val(response.numero);

            }

            $(".errorforms").remove();
        }, complete: function () {
            $("#form_bienestaruniversitario").dialog("open");
        }
    });
}


//mensaje
function asunto(id_solicitud_servicio) {
    $.ajax({
        url: base_url + "gestionsolicitudes/mensajeBienestaruniversitario",
        type: 'POST',
        data: {"id_solicitud_servicio": id_solicitud_servicio},
        success: function (response) {
        
            $('#asunto').val(response.asunto);
            $("#modal_mensaje").modal("show");
        }
    });
}


