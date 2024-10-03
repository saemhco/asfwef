$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_convocatoria_postulantes = $("#tbl_convocatoria_postulantes").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroconvocatorias/datatablePostulaantes4/" + perfil_puesto + "/" + convocatoria, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        "order": [[1, "asc"]],
        "columnDefs": [
            { "targets": 2, "width": "70px" },
            { "targets": 3, "className": "text-center" },
            { "targets": 4, "className": "text-center" }
            
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },
            { "data": "nro_doc", "name": "nro_doc", "width": "20%" },
            { "data": "fullname", "name": "fullname", "width": "45%" },
            { "data": "codigo", "name": "codigo" },
            { "data": "codigo", "name": "codigo" }

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convocatoria_postulantes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var datos_generales = "";
            datos_generales = "<button onclick='datos_generales(" + data.publico + "," + convocatoria + ")' class='btn btn-xs btn-warning' ><i class='fa fa-user' ></i></button>";
            $('td', row).eq(3).html(datos_generales);

            var proceso = "";
            proceso = "<button onclick='proceso(" + data.publico + ")' class='btn btn-xs btn-primary' ><i class='fa fa-check-circle'></i></button>";
            $('td', row).eq(4).html(proceso);

        }
    });

    //valida enter
    $("#form_convocatorias_perfiles .input").keypress(function (e) {
        if (e.which === 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#form_funciones").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Funciones</h4></div>",
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

    //datos generales
    $("#form_datos_generales").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Datos Generales</h4></div>",
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

        }
    });

});

function proceso(publico) {
    $(".errorforms").hide();
    $("#form_proceso")[0].reset();
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/getResultadosConvocatorias4",
        data: { publico: publico },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {



                $("#input-" + i).val(val);

                if (i == "chk_cv") {
                    if (val == '1') {
                        $("#input-" + i).prop("checked", true);
                    }
                }

                if (i == "chk_entrevista") {
                    if (val == '1') {
                        $("#input-" + i).prop("checked", true);
                    }
                }

                if (i == "chk_examen") {
                    if (val == '1') {
                        $("#input-" + i).prop("checked", true);
                    }
                }



            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#input-publico").val(publico);
            $("#form_proceso").dialog("open");
        }
    });
}


//modal proceso
$("#form_proceso").dialog({
    autoOpen: false,
    width: $(window).width() * (($(window).width() > 1024) ? 0.3 : 0.3),
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Acciones</h4></div>",
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

            frm = $("#form_proceso");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (msg) {
                    var result = msg;
                    if (result.say === "yes") {
                        // $("#modalnew").modal("hide");
                        $('#tbl_atenciones').dataTable().fnDraw();
                        bootbox.alert("<strong>Se registró correctamente</strong>");
                        $("#form_proceso").dialog("close");
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

function datos_generales(publico, convocatoria) {
    $(".error_foto").remove();
    $(".form_datos_generales").remove();
    $.ajax({
        type: 'POST',
        url: base_url + "registroconvocatorias/getPublicoDatosGenerales",
        data: { id: publico, convocatoria:convocatoria },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {


                $("#input-" + i).val(val);


                if (i === "archivo_proyecto") {
                    //console.log("tiene archivo"+val);
                    if (val === "" || val === null) {

                        var valor = '<div class="alert alert-warning fade in form_datos_generales"><i class="fa-fw fa fa-warning"></i>No ha subido un archivo...</div>';
                        $("#input-archivo_proyecto").after(valor);

                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos_generales">Click aqui para ver el archivo<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/convocatorias_publico/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivo_proyecto").after(valor);
                    }
                }

            });

            $(".errorforms").remove();
        }, complete: function () {
            $("#form_datos_generales").dialog("open");
        }
    });
}

