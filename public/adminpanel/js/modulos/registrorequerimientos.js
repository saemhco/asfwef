$(document).ready(function () {

    if (id_area !== "") {
        carga_personal(id_area, id_personal);
    }

    if (id_personal !== "") {
        carga_equipos(id_personal, id_personal_area_equipo);
    }






    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_hdt_req_servicio = $("#tbl_hdt_req_servicio").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registrorequerimientos/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[4, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "fecha_req", "name": "fecha_req" },
            { "data": "hora_req", "name": "hora_req" },
            { "data": "tiposervicio", "name": "tiposervicio" },
            { "data": "proceso", "name": "proceso" },
            { "data": "estado", "name": "estado" },
            { "data": "estado", "name": "estado" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_hdt_req_servicio'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            var pk = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_req_servicio + '" proceso="' + data.proceso + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(pk);

            console.log("Proceso: " + data.proceso);


            var acciones = "";
            acciones = "<button class='btn btn-xs btn-primary' onclick='finalizar(" + data.id_req_servicio + ")' >Finalizar</button>";
            $('td', row).eq(5).html(acciones);





            var estado = "";
            if (data.estado === 'A') {
                estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(estado);





        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_hdt_req_servicio').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    //exito datos guardados
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
                window.location.href = base_url + "registrorequerimientos";
            }
        }]
    });





    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_tbl_hdt_req_servicio");

        var frm = new FormData(document.getElementById("form_tbl_hdt_req_servicio"));

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

                    $("#success").dialog("open");

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    $.each(result, function (i, val) {
                        $("#input-" + i).focus();
                        $("#input-" + i).after(val);
                        // if (i === "id_tipo_servicio") {
                        //     var val = '<div class="text-danger errorforms">El campo tipo de servicio es requerido</div>';
                        //     $("#input-id_tipo_servicio").after(val);
                        // }

                        // if (i === "id_prioridad") {
                        //     var val = '<div class="text-danger errorforms">El campo prioridad es requerido</div>';
                        //     $("#input-id_prioridad").after(val);
                        // }


                        // if (i === "id_area") {
                        //     var val = '<div class="text-danger errorforms">El campo area es requerido</div>';
                        //     $("#input-warning_id_area").after(val);
                        // }

                        // if (i === "id_personal") {
                        //     var val = '<div class="text-danger errorforms">El campo personal es requerido</div>';
                        //     $("#input-warning_id_personal").after(val);
                        // }

                        // if (i === "fecha_inicio") {
                        //     var val = '<div class="text-danger errorforms">El campo fecha de inicio es requerido</div>';
                        //     $("#input-fecha_inicio").after(val);
                        // }

                        // if (i === "fecha_fin") {
                        //     var val = '<div class="text-danger errorforms">El campo fecha de fin es requerido</div>';
                        //     $("#input-fecha_fin").after(val);
                        // }




                    });
                }
            }
        });
    });


    //valida enter
    $("#form_tbl_hdt_req_servicio .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $('#input-hora_req').timepicker();
    //$('#input-id_area').select2();
    //$('#input-id_personal').select2();
    //$('#input-id_personal_area_equipo').select2();


    $("#input-id_area").on("change", function () {
        carga_personal($(this).val(), 0);
        var html = '<option value="">SELECCIONE...</option>';
        $("#input-id_personal_area_equipo").html(html);
    });

    $("#input-id_personal").on("change", function () {
        carga_equipos($(this).val(), 0);
    });

});

function carga_personal(id, param) {

    $.post(base_url + "registrorequerimientos/getPersonal", { id: id }, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';
        $.each(response, function (i, val) {
            // console.log("param: "+param);
            if (param == 0) {
                html = html + '<option value="' + val.id_personal + '">' + val.apellidop + " " + val.apellidom + " " + val.nombres + '</option>';
            } else {
                if (val.id_personal == param) {

                    html = html + '<option value="' + val.id_personal + '" selected >' + val.apellidop + " " + val.apellidom + " " + val.nombres + '</option>';
                } else {
                    html = html + '<option value="' + val.id_personal + '">' + val.apellidop + " " + val.apellidom + " " + val.nombres + '</option>';
                }
            }

        });

        $("#input-id_personal").html(html);

        //$("#input-id_personal").html(html).select2();

    }, "json");

}

function carga_equipos(id, param) {

    // console.log(id);
    // console.log(param);

    $.post(base_url + "registrorequerimientos/getEquipos", { id: id }, function (response) {
        var html = "";
        html = html + '<option value="">SELECCIONE...</option>';
        $.each(response, function (i, val) {
            //console.log(param);
            //console.log(val.id_personal_area_equipo);

            if (param == 0) {
                html = html + '<option value="' + val.id_personal_area_equipo + '" >' + "Patrimonial: " + val.patrimonial + " - Tipo Equipo: " + val.tipo_nombre + " - Marca: " + val.marca + " - Modelo: " + val.modelo + " - Serie: " + val.serie + " - Color: " + val.color + '</option>';
            } else {
                if (val.id_personal_area_equipo == param) {

                    html = html + '<option value="' + val.id_personal_area_equipo + '" selected >' + "Patrimonial: " + val.patrimonial + " - Tipo Equipo: " + val.tipo_nombre + " - Marca: " + val.marca + " - Modelo: " + val.modelo + " - Serie: " + val.serie + " - Color:" + val.color + '</option>';
                } else {
                    html = html + '<option value="' + val.id_personal_area_equipo + '">' + "Patrimonial: " + val.patrimonial + " - Tipo Equipo:" + val.tipo_nombre + " - Marca: " + val.marca + " - Modelo: " + val.modelo + " - Serie: " + val.serie + " - Color: " + val.color + '</option>';
                }
            }

        });
        $("#input-id_personal_area_equipo").html(html);
        //$("#input-id_personal_area_equipo").html(html).select2();

    }, "json");

}


function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_comunicado").val("");
    $("#form_tbl_hdt_req_servicio")[0].reset();
    $("#form_tbl_hdt_req_servicio").dialog("open");
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "registrorequerimientos/registro/" + xsmart;






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
                            url: base_url + "registrorequerimientos/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_hdt_req_servicio').dataTable().fnDraw();
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

function finalizar(id_req_servicio) {
    bootbox.confirm({
        message: "<strong>¿Está seguro que desea finalizar el requerimiento ?</strong>",
        buttons: {
            confirm: {
                label: 'Aceptar',
                className: 'btn-primary'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            //console.log('This was logged in the callback: ' + result);
            if (result === true) {
                $.ajax({
                    url: base_url + "registrorequerimientos/finalizar",
                    type: 'POST',
                    data: { "id_req_servicio": id_req_servicio },
                    success: function (msg) {

                        if (msg.say == "yes") {
                            //$('#tbl_postulantes').dataTable().fnDraw();


                            bootbox.alert("<strong>El requerimiento a finalizado correctamente...</strong>", function () {
                                $('#tbl_hdt_req_servicio').dataTable().fnDraw();
                            });

                        } else {
                            //alert("error");

                        }
                    }
                });
            }
        }
    });




}