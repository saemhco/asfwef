$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    console.log(base_url + "gestionconvocatorias/datatableValidarPago");
    tbl_registrosolicitudesalumnos = $("#tbl_registrovoucherdocente").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "gestionconvocatorias/datatableValidarPago", "type": "POST"},
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
                var archivo = "";
                if (data.estado == 0) {
                    estadonom = "<button class='btn btn-xs btn-info' style = 'pointer-events: none;'>Pendiente</button>";
                    estado = "<button  onclick='aprobar(" + data.voucher + ")' class='btn btn-xs btn-primary'>Aprobar</button>\n\
                    <button  class='btn btn-xs btn-warning' onclick='denegar(" + data.voucher + ")' >Rechazar</button>";

                } else if (data.estado == 1) {
                    //estado = '<h4><span class="label label-success">Aprobado </span></h4>';
                    estadonom = "<button class='btn btn-xs btn-success' style = 'pointer-events: none;'>Aprobado</button>";
                    estado = "<a role='button' class='btn btn-xs btn-warning'  style='margin-right: 5px;' href='subirdocumento/"+data.voucher+"' >   <i class=\"fa fa-upload\"></i></a>";
                    estado = estado+"<button  onclick='enviaremail(" + data.voucher + "," + data.codigo + ")'  style='margin-right: 5px;'  class='btn btn-xs btn-primary'>   <i class=\"fa fa-paper-plane\"></i></button>";
                    //estado = "<button class='btn btn-xs btn-success' style = 'pointer-events: none;'>Aprobado</button>";
                    archivo = "<a role='button' class='btn btn-xs btn-warning m-5' style='margin-right: 5px;' target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/baseconcurso.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    archivo  = archivo+"<a role='button' class='btn btn-xs btn-info m-5' style='margin-right: 5px;'  target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/declaracionjurada.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    archivo = archivo+"<a role='button' class='btn btn-xs btn-success m-5' style='margin-right: 5px;'  target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/declaracionjuradafa.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";
                    archivo = archivo+"<a role='button' class='btn btn-xs btn-danger m-5' style='margin-right: 5px;'  target='_BLANK' href='" + base_url + "adminpanel/archivos/basedocente/" + data.voucher + "/solicitudinscripcion.pdf' >   <i class='fa fa-file-pdf-o' ></i></a>";



                } else if (data.estado == 2) {
                    //estado = '<h4><span class="label label-danger">Denegado </span></h4>';
                    estadonom = "<button class='btn btn-xs btn-danger' style = 'pointer-events: none;'>Rechazado</button>";
                    estado = "";
                    //estado = "<button class='btn btn-xs btn-danger' style = 'pointer-events: none;'>Rechazado</button>";
                }
                $('td', row).eq(7).html(estadonom);
                $('td', row).eq(8).html(estado+archivo);


            }
        }
    );


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
        frm = $("#form_voucher_docente_documento");

        var data=URLToArray(frm.serialize());

        console.log(data.input_file);
       // $("#codigo_asignatura_vacio").dialog("open");
        //CuriositySoundError();
        var frmdata = new FormData(document.getElementById("form_voucher_docente_documento"));
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

                   // $("#save_asignatura").dialog("open");
                   // CuriositySoundError();

                } else {
                    bootbox.alert("<strong>"+result.mensaje+"</strong>");
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();
                }
            }
        });
    });


    //save 
    $("#save_asignatura").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [{
            html: "Aceptar",
            "class": "btn btn-success btn-sm ",
            click: function () {
                $(this).dialog("close");
                window.location.href = base_url + "registrouniversidades";
            }
        }]
    });

});

function subirarchivo(indice){
    $.ajax({
        type: 'POST',
        url: base_url + "gestionconvocatorias/subirdocumento",
        data: {"indice":indice},
        dataType: 'html',
        success: function (response) {
            $("#frm_subir_documento").html(response);
            $("#form_subir_voucher_docente").dialog({
                modal: true,
                width: 550,
                height:280,
                title: 'Subir Bases'
            });
        }
    });

}


function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registrouniversidades/registro/" + xsmart;
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
                            url: base_url + "registrouniversidades/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_web_universidades').dataTable().fnDraw();
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

function aprobar(indice) {
    bootbox.confirm("<strong>¿Esta seguro que desea aprobar?</strong>", function (result) {
        if (result === true) {
            //console.log(result);
            bootbox.prompt({
                title: 'Ingrese el mensaje de aprobacion',
                required: true,
                backdrop:"static",
                callback: function(resultado) {
                    $.ajax({
                        url: base_url + "gestionconvocatorias/aprobar",
                        type: 'POST',
                        data: {"indice": indice,"mensaje":resultado},
                        success: function (response) {
                            if (response.say === "yes") {
                                $('#tbl_registrovoucherdocente').dataTable().fnDraw();
                            } else if (response.say === "no_start") {
                                //alert("error");\
                                bootbox.alert("<strong>Alumno aún no ha inicado el proceso de matrícula</strong>");
                            }
                        }
                    });
                }
            });
        }

    });
}

//denegar
function denegar(indice) {
    bootbox.confirm("<strong>¿Está seguro que desea Rechazar?</strong>", function (result) {
        if (result === true) {
            //console.log(result);
var mensaje='';'',
            bootbox.prompt({
                title: 'Ingrese el motivo del rechazo',
                required: true,
                backdrop:"static",
                callback: function(result) {
                    if (result == '') {
                        alert('Tiene que ingresar un mensaje')
                    } else if (result !== null) {
                        $.ajax({
                            url: base_url + "gestionconvocatorias/denegar",
                            type: 'POST',
                            data: {"indice": indice, "mensaje": result},
                            success: function (response) {
                                if (response.say === "yes") {
                                    $('#tbl_registrovoucherdocente').dataTable().fnDraw();
                                } else if (response.say === "no_start") {
                                    //alert("error");
                                    bootbox.alert("<strong>Alumno aún no ha inicado el proceso de matrícula</strong>");
                                }
                            }
                        });

                    }
                }
            });
        }
    });
}

function enviaremail(indice,codigo){
    bootbox.confirm("<strong>¿Está seguro de enviar el correo electronico?</strong>", function (result) {
        if (result === true) {
            $.ajax({
                url: base_url + "gestionconvocatorias/enviaremail",
                type: 'POST',
                data: {"indice": indice,"codigo":codigo},
                success: function (response) {
                    console.log(indice);
                }
            });
        }
    })
}