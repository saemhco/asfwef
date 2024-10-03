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
        var id_proceso = $('#id_proceso').val();

        $('#tbl_admision').DataTable().destroy();

        tbl_admision = $("#tbl_admision").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "registropagos/datatablePostulantes/" + id_admision_enae + "/" + id_proceso, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"], [11, "asc"]],
            "columnDefs": [
                { "targets": 10, "className": "text-center" },
                { "width": "60px", "targets": 11 }
            ],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

                { "data": "publico", "name": "publico" },
                { "data": "nombres_apellidos", "name": "nombres_apellidos" },
                { "data": "nro_doc", "name": "nro_doc" },
                { "data": "celular", "name": "celular" },
                { "data": "email", "name": "email" },
                { "data": "fecha_recibo", "name": "fecha_recibo" },
                { "data": "nro_recibo", "name": "nro_recibo" },
                { "data": "monto_recibo", "name": "monto_recibo" },
                { "data": "archivo_recibo", "name": "archivo_recibo" },
                { "data": "foto", "name": "foto" },
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

                if (data.archivo_recibo) {
                    //console.log(data.imagen);
                    // var imagen = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/imagenes/admision/" + data.imagen + "' >   <i class='fa fa-image' ></i></a>";
                    imagen = "<button onclick='imagen_voucher(\"" + data.archivo_recibo + "\")' class='btn btn-xs btn-warning' ><i class='fa fa-image'></i></button>";
                    $('td', row).eq(9).html(imagen);
                }
    
    
                var foto = '';
                //console.log(data.foto);
                if (data.foto) {
                    var foto = "<button onclick='imagen_foto(\"" + data.foto + "\")' class='btn btn-xs btn-warning' ><i class='fa fa-image'></i></button>";
                }
    
                $('td', row).eq(10).html(foto);
    
    
                var proceso = "";
                if (data.proceso === 'Por verificar') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-warning' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso === 'En verificación') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-primary' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso === 'Verificado') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-success' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso === 'Observado') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-danger' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                }
                $('td', row).eq(11).html(proceso);

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



    });


    $("#id_proceso").on("change", function () {
        var responsiveHelper_dt_basic = undefined;

        var id_admision_enae = $('#id_admision_enae').val();
        var id_proceso = $(this).val();


        $('#tbl_admision').DataTable().destroy();

        tbl_admision = $("#tbl_admision").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "registropagos/datatablePostulantes/" + id_admision_enae + "/" + id_proceso, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"], [11, "asc"]],
            "columnDefs": [
                { "targets": 10, "className": "text-center" },
                { "width": "60px", "targets": 11 }
            ],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

                { "data": "publico", "name": "publico" },
                { "data": "nombres_apellidos", "name": "nombres_apellidos" },
                { "data": "nro_doc", "name": "nro_doc" },
                { "data": "celular", "name": "celular" },
                { "data": "email", "name": "email" },
                { "data": "fecha_recibo", "name": "fecha_recibo" },
                { "data": "nro_recibo", "name": "nro_recibo" },
                { "data": "monto_recibo", "name": "monto_recibo" },
                { "data": "archivo_recibo", "name": "archivo_recibo" },
                { "data": "foto", "name": "foto" },
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

                if (data.archivo_recibo) {
                    //console.log(data.imagen);
                    // var imagen = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/imagenes/admision/" + data.imagen + "' >   <i class='fa fa-image' ></i></a>";
                    imagen = "<button onclick='imagen_voucher(\"" + data.archivo_recibo + "\")' class='btn btn-xs btn-warning' ><i class='fa fa-image'></i></button>";
                    $('td', row).eq(9).html(imagen);
                }
    
    
                var foto = '';
                //console.log(data.foto);
                if (data.foto) {
                    var foto = "<button onclick='imagen_foto(\"" + data.foto + "\")' class='btn btn-xs btn-warning' ><i class='fa fa-image'></i></button>";
                }
    
                $('td', row).eq(10).html(foto);
    
    
                var proceso = "";
                if (data.proceso === 'Por verificar') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-warning' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso === 'En verificación') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-primary' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso === 'Verificado') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-success' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                } else if (data.proceso === 'Observado') {
                    proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-danger' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";
    
                }
                $('td', row).eq(11).html(proceso);

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



    });


    var id_admision_enae = $('#id_admision_enae').val();

    tbl_admision = $("#tbl_admision").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registropagos/datatablePostulantes/" + id_admision_enae, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

            { "data": "publico", "name": "publico" },
            { "data": "nombres_apellidos", "name": "nombres_apellidos" },
            { "data": "nro_doc", "name": "nro_doc" },
            { "data": "celular", "name": "celular" },
            { "data": "email", "name": "email" },
            { "data": "fecha_recibo", "name": "fecha_recibo" },
            { "data": "nro_recibo", "name": "nro_recibo" },
            { "data": "monto_recibo", "name": "monto_recibo" },
            { "data": "archivo_recibo", "name": "archivo_recibo" },
            { "data": "foto", "name": "foto" },
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



            if (data.archivo_recibo) {
                //console.log(data.imagen);
                // var imagen = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/imagenes/admision/" + data.imagen + "' >   <i class='fa fa-image' ></i></a>";
                imagen = "<button onclick='imagen_voucher(\"" + data.archivo_recibo + "\")' class='btn btn-xs btn-warning' ><i class='fa fa-image'></i></button>";
                $('td', row).eq(9).html(imagen);
            }


            var foto = '';
            //console.log(data.foto);
            if (data.foto) {
                var foto = "<button onclick='imagen_foto(\"" + data.foto + "\")' class='btn btn-xs btn-warning' ><i class='fa fa-image'></i></button>";
            }

            $('td', row).eq(10).html(foto);


            var proceso = "";
            if (data.proceso === 'Por verificar') {
                proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-warning' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";

            } else if (data.proceso === 'En verificación') {
                proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-primary' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";

            } else if (data.proceso === 'Verificado') {
                proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-success' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";

            } else if (data.proceso === 'Observado') {
                proceso = "<button onclick='proceso(" + data.convocatoria + "," + data.publico + ")' class='btn btn-xs btn-danger' > " + data.proceso + " <i class='fa fa-check-circle'></i></button>";

            }
            $('td', row).eq(11).html(proceso);


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
        window.open(base_url + "reportes/concursodocentes/" + fecha_inicio + "/" + fecha_fin);
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
        window.open(base_url + "exportar/concursodocentes/" + fecha_inicio + "/" + fecha_fin);
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
        url: base_url + "registropagos/getAdmisionPostulantesa",
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

    var id_admision_enae = $('#id_admision_enae').val();

    $("#input-imagen").attr("src", base_url + "adminpanel/imagenes/convocatorias_publico/recibos/" + id_admision_enae + "/" + imagen);
    $("#modal_registro_voucher").dialog("open");


}



function imagen_foto(imagen) {
    //console.log("Testing");
    $('#input-foto').removeAttr('src');
    $("#input-foto").attr("src", base_url + "adminpanel/imagenes/publico/" + imagen);
    $("#modal_foto").dialog("open");
}
