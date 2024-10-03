$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_planillas = $("#tbl_planillas_personal").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroplanillas/datatablePlanillaDetalleDocentes/" + codigo, "type": "POST" },
        "processing": false,
        "serverSide": true,

        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "apellidop", "name": "apellidop" },
            { "data": "meta", "name": "meta" },
            { "data": "d_tard", "name": "d_tard" },
            { "data": "d_inas", "name": "d_inas" },
            { "data": "d_judicial", "name": "d_judicial" },
            { "data": "afp", "name": "tpp.afp" },
            { "data": "diastrab", "name": "diastrab" },
            { "data": "estado", "name": "estado" },
            { "data": "estado", "name": "estado" },
            { "data": "apellidom", "name": "apellidom", "visible": false },
            { "data": "nombres", "name": "nombres", "visible": false }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_planillas_personal'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_planilla_detalle + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var titulo = data.apellidop + " " + data.apellidom + " " + data.nombres;
            $('td', row).eq(1).html(titulo);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(9).html(html_estado);

            // la wea del regimen
            var regimen = "";
            if (data.afp == 0) {
                regimen = regimen + ' <label class="select">';
                regimen = regimen + '<select id="input-regimen" class="select-reg"  name="regimen"  onChange="AfpSet(this)">';
                regimen = regimen + '<option value="" >SELECCIONE...</option>';

                $.each(regimens_object, function (key, val) {

                    var text_reg = "";
                    if (val.regimen == 1) {
                        text_reg = "SNP";
                    } else {
                        text_reg = "SPP";
                    }
                    regimen = regimen + '<option value="' + codigo + "-" + data.personal + "-" + val.codigo + '" >[' + text_reg + '] ' + val.nombre + '</option>';
                })

                regimen = regimen + '</select> <i></i>';
                regimen = regimen + '</label>';
            } else {

                regimen = regimen + ' <label class="select">';
                regimen = regimen + '<select id="input-regimen" class="select-reg"  name="regimen"  onChange="AfpSet(this)">';
                regimen = regimen + '<option value="" >SELECCIONE...</option>';

                $.each(regimens_object, function (key, val) {
                    var text_reg = "";
                    if (val.regimen == 1) {
                        text_reg = "SNP";
                    } else {
                        text_reg = "SPP";
                    }

                    if (data.afp == val.codigo) {
                        regimen = regimen + '<option selected="selected" value="' + codigo + "-" + data.personal + "-" + val.codigo + '" >[' + text_reg + '] ' + val.nombre + '</option>';
                    } else {
                        regimen = regimen + '<option value="' + codigo + "-" + data.personal + "-" + val.codigo + '" >[' + text_reg + '] ' + val.nombre + '</option>';
                    }

                })

                regimen = regimen + '</select> <i></i>';
                regimen = regimen + '</label>';
            }
            $('td', row).eq(3).html(regimen);

            // la wea de los dias trabajados
            var dias_trabajados = "";
            dias_trabajados = "<input type='text' style='width:50px !important;' onfocusout='setDiasTrab(" + codigo + "," + data.personal + "," + "this)' class='form-control input-xs'  value='" + data.diastrab + "' >";
            $('td', row).eq(2).html(dias_trabajados);

            // descuentos XD
            var inasistencia = "";
            inasistencia = "<input type='text' style='width:80px !important;text-align:right;' onfocusout='setDscInas(" + codigo + "," + data.personal + "," + "this)' class='form-control input-xs'  value='" + data.d_inas+ "' >";
            $('td', row).eq(5).html(inasistencia);


            var tardanza = "";
            tardanza = "<input type='text' style='width:80px !important;text-align:right;' onfocusout='setDscTard(" + codigo + "," + data.personal + "," + "this)' class='form-control input-xs'  value='" + data.d_tard + "' >";
            $('td', row).eq(6).html(tardanza);




            var d_judicial = "";
            d_judicial = "<input type='text' style='width:80px !important;text-align:right;' onfocusout='setDscJudicial(" + codigo + "," + data.personal + "," + "this)' class='form-control input-xs'  value='" + data.d_judicial + "' >";
            $('td', row).eq(7).html(d_judicial);

            //boton del pago
            var button = "<button class='btn btn-xs btn-info' onclick='salario(" + codigo + "," + data.personal + ")' ><i class='fa fa-money' ></i></button>";
            var button_pdf = "<button class='btn btn-xs btn-info' onclick='salarioPdf(" + codigo + "," + data.personal + ")' ><i class='fa fa-print' ></i></button>";
            $('td', row).eq(8).html(button + " " + button_pdf);


            // la wea de la meta
            // la wea del regimen


            var meta = "";
            if (data.meta == "") {

                meta = meta + ' <label class="select">';
                meta = meta + '<select width="50px !important;" id="input-meta" class="select-reg"  name="meta"  onChange="MetaSet(this)">';
                meta = meta + '<option value="" >SELECCIONE...</option>';


                $.each(metas_object, function (key, val) {

                    meta = meta + '<option value="' + codigo + "-" + data.personal + "-" + val.codigo + '" >' + val.codigo + " - " + val.nombre + '</option>';
                })

                meta = meta + '</select> <i></i>';
                meta = meta + '</label>';
            } else {

                meta = meta + ' <label class="select">';
                meta = meta + '<select width="50px !important;" id="input-meta" class="select-reg"  name="meta"  onChange="MetaSet(this)">';
                meta = meta + '<option value="" >SELECCIONE...</option>';

               
                $.each(metas_object, function (key, val) {

                    //console.log("llega data.meta:" +(typeof(data.meta)));
                    //console.log("llega val.codigo:" +(typeof(val.codigo)));


                    if (data.meta === val.codigo) {
                        console.log("llega data.meta:" + data.meta);
                        console.log("llega val.codigo:" + val.codigo);
             
                        meta = meta + '<option selected="selected" value="' + codigo + "-" + data.personal + "-" + val.codigo + '" > ' + val.nombre + '</option>';
                    } else {

                        meta = meta + '<option value="' + codigo + "-" + data.personal + "-" + val.codigo + '" >'+ val.nombre + '</option>';
                    }

                })

                meta = meta + '</select> <i></i>';
                meta = meta + '</label>';
            }
            $('td', row).eq(4).html(meta);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div#tbl_planillas_personal_filter.dataTables_filter input').unbind();
            $('div#tbl_planillas_personal_filter.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_planillas_personal').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    var responsiveHelper_dt_basicx = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinitionx = {
        tablet: 1024,
        phone: 480
    };

    tbl_planillas_cont = $("#tbl_planillas_cont").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroplanillas/datatableCont", "type": "POST" },
        "processing": false,
        "serverSide": true,

        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "apellidop", "name": "apellidop" },
            { "data": "areas", "name": "tpc.dependencia" },
            { "data": "estado", "name": "tpc.estado" },
            { "data": "codigo", "name": "tpc.codigo" },
            { "data": "apellidom", "name": "apellidom", "visible": false },
            { "data": "nombres", "name": "twp.nombres", "visible": false }
        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basicx) {
                responsiveHelper_dt_basicx = new ResponsiveDatatablesHelper($('#tbl_planillas_cont'), breakpointDefinitionx);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basicx.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basicx.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" pk2="' + data.anio + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var titulo = data.apellidop + " " + data.apellidom + " " + data.nombres;
            $('td', row).eq(1).html(titulo);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(3).html(html_estado);


            if (data.codigo) {
                //html_cod = '<button type="button" onclick="agregarDet('+data.personal_code+",'"+anio+"','"+codigo+"'"+')" class="btn btn-xs btn-info">Agregar</button>';

            }
            //$('td', row).eq(4).html(html_cod);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div#tbl_planillas_cont_filter.dataTables_filter input').unbind();
            $('div#tbl_planillas_cont_filter.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_planillas_cont').dataTable().fnFilter(this.value);
                }
            });
        }
    });



})

function setDiasTrab(planilla, personal, t) {
    var respuesta = t.value;

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanillaDiastrab",
        data: { personal: personal, planilla: planilla, diastrab: respuesta },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });
}

function setDscInas(planilla, personal, t) {
    var respuesta = t.value;

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanillaDscInas",
        data: { personal: personal, planilla: planilla, d_inas: respuesta },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });
}


function setDscTard(planilla, personal, t) {
    var respuesta = t.value;

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanillaDscTard",
        data: { personal: personal, planilla: planilla, d_tard: respuesta },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });
}

function setDscJudicial(planilla, personal, t) {
    var respuesta = t.value;

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanillaJudicial",
        data: { personal: personal, planilla: planilla, d_judicial: respuesta },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });
}

function AfpSet(t) {

    var respuesta = t.value;
    console.log("AfpSet:" + respuesta);
    respuesta = respuesta.split("-");

    var planilla = respuesta[0];
    var personal = respuesta[1];
    var afp = respuesta[2];

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanillaAfp",
        data: { personal: personal, planilla: planilla, afp: afp },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });

}

function MetaSet(t) {

    var respuesta = t.value;
    respuesta = respuesta.split("-");


    var planilla = respuesta[0];
    var personal = respuesta[1];
    var meta = respuesta[2];

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanillaMeta",
        data: { personal: personal, planilla: planilla, meta: meta },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });

}

function modalCont() {

    $("#modalcont").modal("show");

}

function agregarDet(personal, anio, planilla) {
    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/saveDetallePlanilla",
        data: { personal: personal, anio: anio, planilla: planilla },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {
                //alert(response.codigo);
                $('#tbl_planillas_cont').dataTable().fnDraw();

                $('#tbl_planillas_personal').dataTable().fnDraw();
            }
        }, complete: function () {
            console.log("load save");
        }
    });
}

function salario(planilla, personal) {
    location.href = base_url + "registroplanillas/detallepago2/" + planilla + "/" + personal;
}

function salarioPdf(planilla, personal) {
    var url_pdf = base_url + "registroplanillas/detallepagoPdf2/" + planilla + "/" + personal;
    window.open(url_pdf, '_blank');
}


