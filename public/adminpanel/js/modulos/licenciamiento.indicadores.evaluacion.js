$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };


    tbl_indicadores = $("#tbl_indicadores").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "licenciamiento/datatableIndicadoresEvaluacion", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

            { "data": "codigo", "name": "codigo" },
            { "data": "nombre", "name": "nombre" },
            { "data": "observaciones", "name": "observaciones" },
            { "data": "cumple", "name": "cumple" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_indicadores'), breakpointDefinition);
            }
        },
        "columnDefs": [
            // { "width": "70px", "targets": 2 },
            { "targets": 3, "className": "text-center" },
            { "targets": 4, "className": "text-center" }
        ],
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var observacion = "";
            observacion = "<button class='btn btn-xs btn-warning' onclick='observacion(" + data.id_indicador + ",\"" + data.nombre + "\")'><i class='fa fa-book'></i></button>";
            $('td', row).eq(3).html(observacion);


            var cumple = "";
            if (data.cumple == 1) {
                cumple = '<label class="cumple"><input type="checkbox" name="checkbox-inline" onclick="cumple(' + data.id_indicador + ')" checked><i></i></label>';
                $('td', row).eq(4).html(cumple);
            } else if (data.cumple == 0 || data.cumple == null) {
                cumple = '<label class="cumple"><input type="checkbox" name="checkbox-inline" onclick="cumple(' + data.id_indicador + ')"><i></i></label>';
                $('td', row).eq(4).html(cumple);
            }


            var estado = "";
            if (data.estado === 'A') {
                estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(estado);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_indicadores').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //valida enter
    $("#form_medios .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#input-condicion").on("change", function () {
        carga_componentes($(this).val(), 0);
        var html = '<option value="">Indicadores</option>';
        $("#input-indicador").html(html);
        //alert("Testing");
    });


    function carga_componentes(id_condicion, param) {
        $.post(base_url + "licenciamiento/getComponentes", { condicion: id_condicion }, function (response) {
            var html = "";
            html = html + '<option value="">Componente</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.id_componente + '">' + val.nombre + '</option>';
                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.id_componente + '" selected >' + val.nombre + '</option>';
                    } else {
                        html = html + '<option value="' + val.id_componente + '">' + val.nombre + '</option>';
                    }
                }

            });

            $("#input-componente").html(html);
        }, "json");
    }



    $("#input-componente").on("change", function () {
        carga_indicadores($("#input-componente").val(), 0);
    });


    function carga_indicadores(id_componente, param) {

        //console.log("componente:"+id_componente);

        $.post(base_url + "licenciamiento/getIndicadoresMediosverificacion", { componente: id_componente }, function (response) {
            var html = "";
            html = html + '<option value="">Indicador</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.id_indicador + '">' + val.nombre + '</option>';
                } else {
                    if (val.id_indicador == param) {

                        html = html + '<option value="' + val.id_indicador + '" selected >' + val.nombre + '</option>';
                    } else {
                        html = html + '<option value="' + val.id_indicador + '">' + val.nombre + '</option>';
                    }
                }

            });

            $("#input-indicador").html(html);
        }, "json");

    }


    $("#input-indicador").on("change", function () {
        //carga_medios($("#input-indicador").val(), 0);
        var input_nombre = $("#input-indicador option:selected").attr("value");
        console.log("id_indicador:" + input_nombre);
        $("#input-id_medio_verificacion").val(input_nombre + '-' + 'MV');
        $("#input-id_indicador").val(input_nombre);


    });


    $("#form_observacion").dialog({
        autoOpen: false,
        //height: "auto",
        width: "850px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4 id='titulo_modal' style='font-size:15px;'></h4></div>",
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

                frm = $("#form_observacion");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {

                            $("#form_observacion").dialog("close");
                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                //$('#tbl_indicadores').dataTable().fnDraw();
                            });


                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();

                            $.each(result, function (i, val) {
                                //$("#input-" + i).focus();
                                $("#input-" + i).blur();
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

});


function cumple(id) {
    $.ajax({
        url: base_url + "licenciamiento/IndicaoresCumple",
        type: 'POST',
        data: { "id": id },
        success: function (msg) {
            if (msg.say == "yes") {
                //$('#tbl_indicadores').dataTable().fnDraw();
            }
        }
    });
}

// function rechazar(id_indicador) {
//     //Limpia los errores y resetea los valores de los campos
//     $(".errorforms").hide();
//     $('#id_indicador').val(id_indicador);
//     $("#form_observacion")[0].reset();
//     $("#form_observacion").dialog("open");
// }


function observacion(id,nombre) {
    var nombre_corto = nombre.substring(0, 50);
    $("#titulo_modal").text(nombre_corto+"...");
    $.ajax({
        type: 'POST',
        url: base_url + "licenciamiento/getAjaxIndicadores",
        data: {id: id},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                $("#input-" + i).val(val);
            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#form_observacion").dialog("open");
        }
    });
}

