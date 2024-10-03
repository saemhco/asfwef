$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_alumnos_solicitudes_becas = $("#tbl_alumnos_solicitudes_becas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionsolicitudes/datatableRegistrosbecas", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha", "name": "fecha"},
            {"data": "tipo", "name": "t.nombres"},
            {"data": "descripcion", "name": "a_so.descripcion"},
            {"data": "archivo", "name": "archivo"},
            {"data": "estado", "name": "a_so.estado"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos_solicitudes_becas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            
            /*
            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.semestre + '" pk2="' + data.alumno + '" pk3="' + data.numero + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);
            */

            var fecha_ini_r1 = data.fecha.split(" ");
            //console.log(res_fecha_ini[0]);

            var fecha_ini_result1 = fecha_ini_r1[0].split("-");
            //console.log(fecha_ini_result1[2]);

            var hora_date = fecha_ini_r1[1].split("-");

            var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
            $('td', row).eq(1).html(fecha_ini_result2 + " - " + hora_date);

            var tipo = data.tipo;
            $('td', row).eq(2).html(tipo);

            var mensaje = "";
            mensaje = "<button onclick='mensaje(" + data.semestre + "," + data.alumno + "," + data.numero + ")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
            $('td', row).eq(3).html(mensaje);


            var archivo = data.archivo;
            if (archivo !== null) {
                var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/solicitudes/becas/FILE-BE-" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                $('td', row).eq(4).html(archivo);
            }


            var html_estado = "";
            if (data.estado === 1) {
                html_estado = '<span class="label label-warning">Pendiente</span>';
            } else if (data.estado === 2) {
                html_estado = '<span class="label label-success">Aprobado</span>';
            } else if (data.estado === 3) {
                html_estado = '<span class="label label-danger">Denegado</span>';
            }
            $('td', row).eq(5).html(html_estado);

        }
    }
    );




    $("#form_alumnos_solicitudes_becas").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Solicitudes Becas</h4></div>",
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
                    frmx = $("#form_alumnos_solicitudes_becas");
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
                                $("#form_alumnos_solicitudes_becas").dialog("close");

                                bootbox.alert({
                                    message: "<strong>Se resgistró correctamente</strong>",
                                    callback: function () {
                                        //location.reload();
                                        $('#tbl_alumnos_solicitudes_becas').dataTable().fnDraw();
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
    $("#form_alumnos_solicitudes_becas")[0].reset();
    $("#input_estado").prop("checked", true);

    var semestre = $("#semestre").val();
    var alumno = $("#alumno").val();

    $.ajax({
        type: 'POST',
        url: base_url + "gestionsolicitudes/getNewAlumnosSolicitudesBecas",
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
            $("#form_alumnos_solicitudes_becas").dialog("open");
        }
    });
}


//mensaje
function mensaje(semestre, alumno, numero) {
    $.ajax({
        url: base_url + "gestionsolicitudes/mensajeAlumnosSolicitudesbecas",
        type: 'POST',
        data: {"semestre": semestre, "alumno": alumno, "numero": numero},
        success: function (response) {
        
            $('#descripcion').val(response.mensaje);
            $("#modal_mensaje").modal("show");
        }
    });
}


