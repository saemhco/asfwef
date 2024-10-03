$(document).ready(function () {


    //alert("Hola Mundo");

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_inv_proyectos = $("#tbl_inv_proyectos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroinvproyectos/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "titulo", "name": "titulo" },
            { "data": "fecha_inicio", "name": "fecha_inicio" },
            { "data": "fecha_termino", "name": "fecha_termino" },
            { "data": "entidad_cooperante", "name": "entidad_cooperante" },
            { "data": "estado", "name": "estado" },

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_inv_proyectos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            var fecha_inicio_split = data.fecha_inicio;
            var fecha_inicio_split_1 = fecha_inicio_split.split(" ");
            var fecha_inicio_split_2 = fecha_inicio_split_1[0].split("-");
            var fecha_inicio = fecha_inicio_split_2[2] + '/' + fecha_inicio_split_2[1] + '/' + fecha_inicio_split_2[0];
            $('td', row).eq(2).html(fecha_inicio);

            var fecha_termino_split = data.fecha_termino;
            var fecha_termino_split_1 = fecha_termino_split.split(" ");
            var fecha_termino_split_2 = fecha_termino_split_1[0].split("-");
            var fecha_termino = fecha_termino_split_2[2] + '/' + fecha_termino_split_2[1] + '/' + fecha_termino_split_2[0];
            $('td', row).eq(3).html(fecha_termino);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_inv_proyectos').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    //valida enter
    $("#form_invproyecto .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter

    $("#form_gestioninvproyectos").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> SEGUIMIENTO DE PROYECTOS </h4></div>",
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
                frm = $("#form_gestioninvproyectos");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            // $("#modalnew").modal("hide");
                            $('#tbl_inv_proyectos').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_gestioninvproyectos").dialog("close");
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
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
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
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


});


function editar() {
    $("#titulo_modal").text();
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "gestioninvproyectos/getAjax",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);
                    if (i === "titulo") {
                        //console.log(val);
                        $("#input-titulo").text(val);
                    }

                    if (i === "avance") {
                        if(val===null || val=== "" || val === "0"){
                            console.log("proceso es null o vacio");
                            $("#input-avance").val("0.00");
                        }
                    }
                    

                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_gestioninvproyectos").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

function reporte_pdf() {
    $(".errorforms").remove();
    $("#form_reporte_pdf")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_pdf").val(fecha_fin_pdf);

    $("#form_reporte_pdf").dialog("open");
}

function reporte_gestioninvproyectos_pdf() {
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
        window.open(base_url + "reportes/reportegestioninvproyectos/" + fecha_inicio + "/" + fecha_fin);
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


function reporte_gestioninvproyectos_xls() {
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
        window.open(base_url + "exportar/exportargestioninvproyectos/" + fecha_inicio + "/" + fecha_fin);
    }
}

