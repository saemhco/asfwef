$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
console.log(base_url + "gestionconvocatorias/datatableDetallePago")
    tbl_registrosolicitudesalumnos = $("#tbl_registrovoucherdocente").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "gestionconvocatorias/datatableDetallePago", "type": "POST"},
            "processing": false,
            "serverSide": true,
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                // {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
                {"data": "titulo", "name": "titulo"},
                {"data": "fecha", "name": "fecha"},
                {"data": "codigo", "name": "codigo"},
                {"data": "nombredocente", "name": "nombredocente"},
                {"data": "archivo", "name": "archivo"},
                {"data": "fechaatencion", "name": "fechaatencion"},
                {"data": "mensaje", "name": "mensaje"},
                {"data": "estado", "name": "estado"},
                {"data": "estado", "name": "estado"}
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_registrovoucherdocente'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {


                /*   var fecha_ini_r1 = data.fecha.split(" ");
                   //console.log(res_fecha_ini[0]);

                   var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                   //console.log(fecha_ini_result1[2]);

                   var hora_date = fecha_ini_r1[1].split("-");

                   var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                   $('td', row).eq(1).html(fecha_ini_result2 + " - " + hora_date);*/

                /*
                                var mensaje = "";
                                mensaje = "<button onclick='mensaje(" + data.semestre + "," + data.alumno + "," + data.numero + ")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
                                $('td', row).eq(5).html(mensaje);*/

                var archivo = data.archivo;
                if (archivo !== null) {
                    var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/voucher/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    $('td', row).eq(4).html(archivo);
                }




                var estadonom = "";
                var estado = "";
                if (data.estado == 0) {
                    estadonom = "<button class='btn btn-xs btn-info' style = 'pointer-events: none;'>Pendiente</button>";


                } else if (data.estado == 1) {
                    //estado = '<h4><span class="label label-success">Aprobado </span></h4>';
                    estadonom = "<button class='btn btn-xs btn-success' style = 'pointer-events: none;'>Aprobado</button>";
                    estado = "";
                    //estado = "<button class='btn btn-xs btn-success' style = 'pointer-events: none;'>Aprobado</button>";

                } else if (data.estado == 2) {
                    //estado = '<h4><span class="label label-danger">Denegado </span></h4>';
                    estadonom = "<button class='btn btn-xs btn-danger' style = 'pointer-events: none;'>Rechazado</button>";
                    estado = "";
                    //estado = "<button class='btn btn-xs btn-danger' style = 'pointer-events: none;'>Rechazado</button>";
                }
                $('td', row).eq(7).html(estadonom);
            var archivo='';
            if (data.estado == 1) {
                 archivo = "<a role='button' class='btn btn-xs btn-warning m-5' style='margin-right: 5px;' target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/baseconcurso.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";
                archivo  = archivo+"<a role='button' class='btn btn-xs btn-info m-5' style='margin-right: 5px;'  target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/declaracionjurada.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";
                archivo = archivo+"<a role='button' class='btn btn-xs btn-success m-5' style='margin-right: 5px;'  target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/declaracionjuradafa.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";
                archivo = archivo+"<a role='button' class='btn btn-xs btn-danger m-5' style='margin-right: 5px;'  target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/solicitudinscripcion.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";

            }
            $('td', row).eq(8).html(archivo);

            }
        }
    );




    $("#form_alumnos_solicitudes").dialog({
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
                    frmx = $("#form_alumnos_solicitudes");
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
                                $("#form_alumnos_solicitudes").dialog("close");

                                bootbox.alert({
                                    message: "<strong>Se resgistro correctamente</strong>",
                                    callback: function () {
                                        //location.reload();
                                        $('#tbl_alumnos_solicitudes').dataTable().fnDraw();
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
function URLToArray(url) {
    var request = {};
    var pairs = url.substring(url.indexOf('?') + 1).split('&');
    for (var i = 0; i < pairs.length; i++) {
        if(!pairs[i])
            continue;
        var pair = pairs[i].split('=');
        request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
    }
    return request;
}
$("#publicar").on("click", function () {
    frm = $("#form_voucher_docente");

    var data=URLToArray(frm.serialize());

    console.log(data.input_file);
    // $("#codigo_asignatura_vacio").dialog("open");
    //CuriositySoundError();
    var frmdata = new FormData(document.getElementById("form_voucher_docente"));
    console.log(frmdata);
    $.ajax({
        url: frm.attr("action"),
        type: 'POST',
        data: frmdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function (msg) {
            console.log(msg);
            var result = msg;
            if (result.say === "yes") {
                bootbox.alert("<strong>"+result.mensaje+"</strong>");
                //window.location.href = base_url + "asignaturas";
                $('#tbl_registrovoucherdocente').dataTable().fnDraw();
                // $("#save_asignatura").dialog("open");
                // CuriositySoundError();

            } else {
                bootbox.alert("<strong>"+result.mensaje+"</strong>");
                console.log("llegamos a la disco");
                $(".errorforms").remove();
            }
            $("#form_voucher_docente").dialog('close');
        }
    });
});
//var ab = document.getElementById("myfile").value.replace('C:\\fakepath\\', '');
function agregar() {
     $.ajax({
        type: 'POST',
        url: base_url + "gestionconvocatorias/getNewVoucher",
        data: {},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {
                //console.log(response.numero);

                $("#input_numero").val(response.numero);

            }

            $(".errorforms").remove();
        }, complete: function () {
             $("#form_voucher_docente").dialog({
                 modal: true,
                 width: 550,
                 height:280,
                 title: 'Registrar Voucher'
             });
        }
    });
}


//mensaje
function mensaje(semestre, alumno, numero) {
    $.ajax({
        url: base_url + "gestionsolicitudes/mensajeAlumnosSolicitudes",
        type: 'POST',
        data: {"semestre": semestre, "alumno": alumno, "numero": numero},
        success: function (response) {
        
            $('#descripcion').val(response.mensaje);
            $("#modal_mensaje").modal("show");
        }
    });
}


