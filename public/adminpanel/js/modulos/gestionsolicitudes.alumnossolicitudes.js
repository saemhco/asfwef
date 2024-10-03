$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_alumnos_solicitudes = $("#tbl_alumnos_solicitudes").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionsolicitudes/datatableAlumnosSolicitudes", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "numero", "name": "a_so.numero"},
            {"data": "tipo", "name": "t.nombres"},
            {"data": "descripcion", "name": "a_so.descripcion"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos_solicitudes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.semestre + '" pk2="' + data.alumno + '" pk3="' + data.numero + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var mensaje = "";
            mensaje = "<button onclick='mensaje(" + data.semestre + "," + data.alumno + "," + data.numero + ")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
            $('td', row).eq(3).html(mensaje);


            var html_estado = "";
            if (data.estado === 1) {
                html_estado = '<span class="label label-warning">Pendiente</span>';
            } else if (data.estado === 2) {
                html_estado = '<span class="label label-success">Aprobado</span>';
            } else if (data.estado === 3) {
                html_estado = '<span class="label label-danger">Denegado</span>';
            }
            $('td', row).eq(4).html(html_estado);

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

//var ab = document.getElementById("myfile").value.replace('C:\\fakepath\\', '');
function agregar() {
    $("#form_alumnos_solicitudes")[0].reset();
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
            $("#form_alumnos_solicitudes").dialog("open");
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


