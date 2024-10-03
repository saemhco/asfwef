$(document).ready(function () {
    //alert("Testing");
    //datatables
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    $("#id_admision_enae").on("change", function () {
        var responsiveHelper_dt_basic = undefined;
        var id_admision_enae = $(this).val();
        $('#tbl_admision').DataTable().destroy();

        tbl_admision = $("#tbl_admision").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "gestionadmision/datatablePostulantesaptos/"+id_admision_enae, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"], [4, "asc"]],
            "columnDefs": [
                {"width": "50px", "targets": 4, "className": "text-center"},
                {"width": "50px", "targets": 5, "className": "text-center"},
                { "targets": 6, "className": "text-center" },
                {"width": "50px", "targets": 7, "className": "text-center"},
                { "targets": 8, "className": "text-center" }
            ],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
    
                { "data": "postulante", "name": "postulante" },
                { "data": "nro_doc", "name": "nro_doc" },
                { "data": "nombres_apellidos", "name": "nombres_apellidos" },
                { "data": "supervisor", "name": "supervisor" },
                { "data": "grupo", "name": "grupo" },
                { "data": "asistencia", "name": "asistencia" },
                { "data": "puntaje", "name": "puntaje" },
                { "data": "observaciones_asistencia", "name": "observaciones_asistencia" },
                { "data": "proceso", "name": "proceso" }
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_admision'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {
    
    
                if (data.supervisor == null) {
                    var supervisor = "";
                    supervisor = '<input type="text" value="" class="form-control" onfocusout="editarSupervisor(' + data.admision + ',' + data.postulante + ')" id="supervisor-' + data.admision + '-' + data.postulante + '" size="2">';
                    $('td', row).eq(4).html(supervisor);
                } else {
    
                    var supervisor = "";
                    supervisor = '<input type="text" value="' + data.supervisor + '" class="form-control" onfocusout="editarSupervisor(' + data.admision + ',' + data.postulante + ')" id="supervisor-' + data.admision + '-' + data.postulante + '" size="2">';
                    $('td', row).eq(4).html(supervisor);
                }
    
                if (data.grupo == null) {
    
                    var grupo = "";
                    grupo = '<input type="text" value="" class="form-control" onfocusout="editarGrupo(' + data.admision + ',' + data.postulante + ')" id="grupo-' + data.admision + '-' + data.postulante + '" size="2">';
                    $('td', row).eq(5).html(grupo);
    
                } else {
    
                    var grupo = "";
                    grupo = '<input type="text" value="' + data.grupo + '" class="form-control" onfocusout="editarGrupo(' + data.admision + ',' + data.postulante + ')" id="grupo-' + data.admision + '-' + data.postulante + '" size="2">';
                    $('td', row).eq(5).html(grupo);
    
                }
    
                var asistencia = "";
                if (data.asistencia === '1') {
                    asistencia = '<center><span class="label label-success">ASISTIÓ</span></center>';
    
                } else if (data.asistencia === '0') {
                    asistencia = '<center><span class="label label-warning">NO ASISTIÓ</span></center>';
                }
                $('td', row).eq(6).html(asistencia);
    
    
                if (data.puntaje == null) {
                    var puntaje = "";
                    puntaje = '<input type="text" value="" class="form-control" onfocusout="editarPuntaje(' + data.admision + ',' + data.postulante + ')" id="puntaje-' + data.admision + '-' + data.postulante + '" size="2">';
                    $('td', row).eq(7).html(puntaje);
                } else {
    
                    var puntaje = "";
                    puntaje = '<input type="text" value="' + data.puntaje + '" class="form-control" onfocusout="editarPuntaje(' + data.admision + ',' + data.postulante + ')" id="puntaje-' + data.admision + '-' + data.postulante + '" size="2">';
                    $('td', row).eq(7).html(puntaje);
                }
    
                if (data.observaciones_asistencia) {
                    var observaciones_asistencia = "";
                    observaciones_asistencia = "<button onclick='observacionesAsistencia(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
                    $('td', row).eq(8).html(observaciones_asistencia);
                }
    
    
                var proceso = "";
                if (data.proceso_nombre === 'Por verificar') {
                    proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-warning' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso_nombre === 'En verificación') {
                    proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-primary' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso_nombre === 'Verificado') {
                    proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-success' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso_nombre === 'Observado') {
                    proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-danger' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";
    
                }
                $('td', row).eq(9).html(proceso);
    
            },
    
            initComplete: function () {
                //Busqueda al dar enter
                $('div.dataTables_filter input').unbind();
                $('div.dataTables_filter input').bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        $('#tbl_admision').dataTable().fnFilter(this.value);
                    }
                });
            }
    
        });
        //fin datatables

    });

    var id_admision_enae = $('#id_admision_enae').val();
    tbl_admision = $("#tbl_admision").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionadmision/datatablePostulantesaptos/"+id_admision_enae, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"], [4, "asc"]],
        "columnDefs": [
            {"width": "50px", "targets": 4, "className": "text-center"},
            {"width": "50px", "targets": 5, "className": "text-center"},
            { "targets": 6, "className": "text-center" },
            {"width": "50px", "targets": 7, "className": "text-center"},
            { "targets": 8, "className": "text-center" }
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

            { "data": "postulante", "name": "postulante" },
            { "data": "nro_doc", "name": "nro_doc" },
            { "data": "nombres_apellidos", "name": "nombres_apellidos" },
            { "data": "supervisor", "name": "supervisor" },
            { "data": "grupo", "name": "grupo" },
            { "data": "asistencia", "name": "asistencia" },
            { "data": "puntaje", "name": "puntaje" },
            { "data": "observaciones_asistencia", "name": "observaciones_asistencia" },
            { "data": "proceso", "name": "proceso" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_admision'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            if (data.supervisor == null) {
                var supervisor = "";
                supervisor = '<input type="text" value="" class="form-control" onfocusout="editarSupervisor(' + data.admision + ',' + data.postulante + ')" id="supervisor-' + data.admision + '-' + data.postulante + '" size="2">';
                $('td', row).eq(4).html(supervisor);
            } else {

                var supervisor = "";
                supervisor = '<input type="text" value="' + data.supervisor + '" class="form-control" onfocusout="editarSupervisor(' + data.admision + ',' + data.postulante + ')" id="supervisor-' + data.admision + '-' + data.postulante + '" size="2">';
                $('td', row).eq(4).html(supervisor);
            }

            if (data.grupo == null) {

                var grupo = "";
                grupo = '<input type="text" value="" class="form-control" onfocusout="editarGrupo(' + data.admision + ',' + data.postulante + ')" id="grupo-' + data.admision + '-' + data.postulante + '" size="2">';
                $('td', row).eq(5).html(grupo);

            } else {

                var grupo = "";
                grupo = '<input type="text" value="' + data.grupo + '" class="form-control" onfocusout="editarGrupo(' + data.admision + ',' + data.postulante + ')" id="grupo-' + data.admision + '-' + data.postulante + '" size="2">';
                $('td', row).eq(5).html(grupo);

            }

            var asistencia = "";
            if (data.asistencia === '1') {
                asistencia = '<center><span class="label label-success">ASISTIÓ</span></center>';

            } else if (data.asistencia === '0') {
                asistencia = '<center><span class="label label-warning">NO ASISTIÓ</span></center>';
            }
            $('td', row).eq(6).html(asistencia);


            if (data.puntaje == null) {
                var puntaje = "";
                puntaje = '<input type="text" value="" class="form-control" onfocusout="editarPuntaje(' + data.admision + ',' + data.postulante + ')" id="puntaje-' + data.admision + '-' + data.postulante + '" size="2">';
                $('td', row).eq(7).html(puntaje);
            } else {

                var puntaje = "";
                puntaje = '<input type="text" value="' + data.puntaje + '" class="form-control" onfocusout="editarPuntaje(' + data.admision + ',' + data.postulante + ')" id="puntaje-' + data.admision + '-' + data.postulante + '" size="2">';
                $('td', row).eq(7).html(puntaje);
            }

            if (data.observaciones_asistencia) {
                var observaciones_asistencia = "";
                observaciones_asistencia = "<button onclick='observacionesAsistencia(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
                $('td', row).eq(8).html(observaciones_asistencia);
            }


            var proceso = "";
            if (data.proceso_nombre === 'Por verificar') {
                proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-warning' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";

            } else if (data.proceso_nombre === 'En verificación') {
                proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-primary' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";

            } else if (data.proceso_nombre === 'Verificado') {
                proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-success' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";

            } else if (data.proceso_nombre === 'Observado') {
                proceso = "<button onclick='proceso(" + data.admision + "," + data.postulante + ")' class='btn btn-xs btn-danger' > " + data.proceso_nombre + " <i class='fa fa-check-circle'></i></button>";

            }
            $('td', row).eq(9).html(proceso);

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_admision').dataTable().fnFilter(this.value);
                }
            });
        }

    });
    //fin datatables




    $("#form_reporte_pdf").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#form_reporte_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte </h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });





    $("#form_procesos").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro</h4></div>",
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
                frmx = $("#form_procesos");
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
                            $('#tbl_admision').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>")
                            $("#form_procesos").dialog("close");
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

    $("#modal_registro_voucher").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Imagen Voucher</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    $("#modal_foto").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Imagen Foto</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    $("#form_observaciones").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i>Observaciones</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

});

function reporte_pdf() {
    $(".errorforms").remove();
    $("#form_reporte_pdf")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_pdf").val(fecha_fin_pdf);

    $("#form_reporte_pdf").dialog("open");
}

function reporte_gestionadmision_postulantes_pdf() {
    $(".errorforms").remove();
    if ($("#input-fecha_inicio_pdf").val() === "" || $("#input-fecha_fin_pdf").val() === "") {
        //console.log("Entra Aqui");
        if ($("#input-fecha_inicio_pdf").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
            $("#input-fecha_inicio_pdf").after(val);
        }
        if ($("#input-fecha_fin_pdf").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
            $("#input-fecha_fin_pdf").after(val);
        }
    } else {
        var fecha_inicio1 = $("#input-fecha_inicio_pdf").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_pdf").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);
        window.open(base_url + "reportes/reportegestionadmisionPostulantes/" + fecha_inicio + "/" + fecha_fin);
    }
}

function reporte_xls() {
    $(".errorforms").remove();
    $("#form_reporte_xls")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_xls").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_xls").val(fecha_fin_pdf);

    $("#form_reporte_xls").dialog("open");
}

function reporte_gestionadmision_postulantes_xls() {
    $(".errorforms").remove();
    if ($("#input-fecha_inicio_xls").val() === "" || $("#input-fecha_fin_xls").val() === "") {
        //console.log("Entra Aqui");
        if ($("#input-fecha_inicio_xls").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
            $("#input-fecha_inicio_xls").after(val);
        }
        if ($("#input-fecha_fin_xls").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
            $("#input-fecha_fin_xls").after(val);
        }
    } else {
        var fecha_inicio1 = $("#input-fecha_inicio_xls").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_xls").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);
        window.open(base_url + "exportar/exportargestionadmisionPostulantes/" + fecha_inicio + "/" + fecha_fin);
    }
}


function editar() {
    if ($(".selrow").is(':checked')) {
        var postulante = $('input:radio[name=selrow]:checked').val();
        var admision = $('input:radio[name=selrow]:checked').attr('pk2');
        $("#input-admision").val(admision);
        $("#input-postulante").val(postulante);
        $.ajax({
            type: 'POST',
            url: base_url + "usuarios/getAjax",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    console.log(val);
                    $("#input-" + i).val(val);
                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_usuarios").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function proceso(admision, postulante) {
    $(".errorforms").hide();
    $("#form_procesos")[0].reset();
    $.ajax({
        type: 'POST',
        url: base_url + "gestionadmision/getAdmisionPostulantesa",
        data: { admision: admision, postulante: postulante },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {

                $("#input-" + i).val(val);
            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#input-admision").val(admision);
            $("#input-postulante").val(postulante);
            $("#form_procesos").dialog("open");
        }
    });
}


function imagen_voucher(imagen) {
    //console.log("Testing");
    $('#input-imagen').removeAttr('src');
    $("#input-imagen").attr("src", base_url + "adminpanel/imagenes/admision/" + imagen);
    $("#input-imagen").attr("src", base_url + "adminpanel/imagenes/admision/" + imagen);
    $("#modal_registro_voucher").dialog("open");
}



function imagen_foto(imagen) {
    //console.log("Testing");
    $('#input-foto').removeAttr('src');
    $("#input-foto").attr("src", base_url + "adminpanel/imagenes/publico/personales/" + imagen);
    $("#modal_foto").dialog("open");
}

function editarSupervisor(admision, postulante) {
    // var x = document.getElementById("fname");
    // x.value = x.value.toUpperCase();
    console.log("Admision:" + admision);
    console.log("Postulante:" + postulante);

    var supervisor = $("#supervisor-" + admision + '-' + postulante).val();
    console.log("supervisor conferencia:" + supervisor);

    $.ajax({
        type: 'POST',
        url: base_url + "gestionadmision/editarSupervisor",
        data: { admision: admision, postulante: postulante, supervisor: supervisor },
        dataType: 'json',
        success: function (response) {
            //console.log(response.say);
            if (response.say === "yes") {
                console.log("yes");
            }
        }
    });
}


function editarGrupo(admision, postulante) {
    // var x = document.getElementById("fname");
    // x.value = x.value.toUpperCase();
    console.log("Admision:" + admision);
    console.log("Postulante:" + postulante);

    var grupo = $("#grupo-" + admision + '-' + postulante).val();


    $.ajax({
        type: 'POST',
        url: base_url + "gestionadmision/editarGrupo",
        data: { admision: admision, postulante: postulante, grupo: grupo },
        dataType: 'json',
        success: function (response) {
            //console.log(response.say);
            if (response.say === "yes") {
                console.log("yes");
            }
        }
    });
}


function editarPuntaje(admision, postulante) {

    console.log("Admision:" + admision);
    console.log("Postulante:" + postulante);

    var puntaje = $("#puntaje-" + admision + '-' + postulante).val();

    $.ajax({
        type: 'POST',
        url: base_url + "gestionadmision/editarPuntaje",
        data: { admision: admision, postulante: postulante, puntaje: puntaje },
        dataType: 'json',
        success: function (response) {
            //console.log(response.say);
            if (response.say === "yes") {
                console.log("yes");
            }
        }
    });
}

function observacionesAsistencia(admision, postulante) {
    //Limpia los errores y resetea los valores de los campos
    $.ajax({
        type: 'POST',
        url: base_url + "gestionadmision/getAjaxObservacionesAsistencia",
        data: { admision: admision, postulante: postulante },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                $("#input-" + i).val(val);
            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#form_observaciones").dialog("open");
        }
    });
}
