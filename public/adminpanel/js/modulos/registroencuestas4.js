$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_alumnos_encuestas = $("#tbl_alumnos_encuestas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroencuestas4/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        'columnDefs': [
            {
                "targets": 7,
                "className": "text-center"
            }
        ],
        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            //{"data": "codigo", "name": "codigo"} asis.horario,
            //{"data": "codigo", "name": "asis.codigo"},


            {"data": "semestre", "name": "s.descripcion"},
            {"data": "fecha", "name": "a_e.fecha"},
            {"data": "id_alumno", "name": "a_e.id_alumno"},
            {"data": "asignatura", "name": "a.nombre"},
            {"data": "id_grupo", "name": "a_e.id_grupo"},
            {"data": "ciclo", "name": "a.ciclo"},
            {"data": "id_encuesta_alumno", "name": "a_e.id_encuesta_alumno"}


            //{"data": "asignatura", "name": "da.asignatura"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos_encuestas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            //console.log(data.fecha);
            var fecha = data.fecha;
            var res_fecha_1 = fecha.split(" ");
            //console.log(res_fecha_1);
            var res_fecha_2 = res_fecha_1[0].split("-");
            //console.log(res_fecha_2);
            var res_fecha_3 = res_fecha_2[2] + '/' + res_fecha_2[1] + '/' + res_fecha_2[0];
            //console.log(res_fecha_3);
            $('td', row).eq(2).html(res_fecha_3);

            var html = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "reportes/reporteencuestas/" + data.id_encuesta_alumno + "' > <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(7).html(html);


        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_alumnos_encuestas').dataTable().fnFilter(this.value);
                }
            });
        }
    });




    //Error encuesta ya registrada para esa asignatura
    $("#error_encuesta_registrada").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "registroencuestas4/registro";
                }
            }]
    });





    //Error asignatura
    $("#error_asignatura").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });

    //Error encuesta
    $("#error_encuesta").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica</h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });

    $("#success").dialog({
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
                    window.location.href = base_url + "registroencuestas4/fin";
                }
            }]
    });


    //Funcion guardar
    $("#publicar").on("click", function () {
        //alert("Fucking bitch");

        //Capturamos el value 0 de asignaturas para validar el campo
        var select = $("#asignatura option:selected").val();



        //Capturamos el codigo de la encuesta
        //console.log("Codigo_asignatura:"+select);

        if (select === "0") {
            //alert("Funcking Bitch 1");
            //bootbox.alert("<strong style='color: #77021D;'>Debe selecionar una asignatura</strong>");

            //$("#error_asignatura").dialog("open");
            //CuriositySoundError();


        } else {
            //Capturamos el value 0 de encuestas para validar el campo
            var select = $("#encuesta option:selected").val();
            if (select === "0") {
                //bootbox.alert("<strong style='color: #77021D;'>Debe selecionar una opcion de encuesta</strong>");
                $("#error_encuesta").dialog("open");
                CuriositySoundError();

            } else {
                bootbox.confirm("<strong>Esta seguro que desea registrar el Test?</strong>", function (result) {
                    //Si va bien
                    if (result === true) {
                        //console.log(result);
                        frm = $("#form_encuestas");
                        $.ajax({
                            url: frm.attr("action"),
                            type: 'POST',
                            data: frm.serialize(),
                            success: function (msg) {
                                var result = msg;
                                if (result.say === "yes")
                                {
                            
                                    $("#success").dialog("open");
                                } else {


                                }
                            }
                        });

                    }
                });
            }

        }



    });



});



