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
        "ajax": {"url": base_url + "convocatoriasbs/datatablePostulaantes/" + perfil_puesto + "/" + convocatoria, "type": "POST"},
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        "order": [[1, "asc"]],
        "columnDefs": [
            {"targets": 3, "className": "text-center"},
            {"targets": 4, "className": "text-center"}
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false},
            {"data": "razon_social", "name": "razon_social"},
            {"data": "ruc", "name": "ruc"},
            {"data": "id_convocatoria_bs_empresa", "name": "id_convocatoria_bs_empresa"},
            {"data": "id_convocatoria_bs_empresa", "name": "id_convocatoria_bs_empresa"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convocatoria_postulantes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {




            var anexos = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/convocatoriasbs_empresa/" + data.anexos + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(3).html(anexos);


            var proceso = "";
            proceso = "<button onclick='proceso(" + data.id_empresa + ")' class='btn btn-xs btn-primary' ><i class='fa fa-check-circle'></i></button>";
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



    //datos personales
    $("#form_datos_personales").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.9 : 0.9), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Datos Personales</h4></div>",
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


function proceso(id_empresa) {
    $(".errorforms").hide();
    $("#form_proceso")[0].reset();
    $.ajax({
        type: 'POST',
        url: base_url + "convocatoriasbs/getResultadosConvocatorias",
        data: {id_empresa: id_empresa},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {

                if (i === "proceso") {

                    $("#input-" + i).val(val);


                }
            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#input-id_empresa").val(id_empresa);
            $("#form_proceso").dialog("open");
        }
    });
}

//modal proceso
$("#form_proceso").dialog({
    autoOpen: false,
    width: $(window).width() * (($(window).width() > 1024) ? 0.2 : 0.2),
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registrar proceso</h4></div>",
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
                        if (result.say === "yes")
                        {
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



//carga provincia
function carga_provincia(region, param) {

    $.post(base_url + "web/getProvincias", {pk: region}, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';

        $.each(response, function (i, val) {
            if (param == 0) {
                html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';

            } else {
                if (val.provincia == param) {

                    html = html + '<option value="' + val.provincia + '" selected >' + val.descripcion + '</option>';
                } else {
                    html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                }
            }

        });
        //console.log('Llega');

        $("#input-provincia").html(html);


    }, "json");

}

//carga distri
function carga_distrito(region, provincia, param) {

    //console.log("region:" + region);
    //console.log("provincia:" + provincia);
    //console.log("distrito:" + param);

    $.post(base_url + "web/getDistritos", {pk: region, idprov: provincia}, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';
        $.each(response, function (i, val) {
            if (param === 0) {
                html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
            } else {


                if (val.distrito === param) {

                    console.log("GAAAAAAAAAAAAAA");

                    html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                } else {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                }
            }

        });

        $("#input-distrito").html(html);
    }, "json");

}


