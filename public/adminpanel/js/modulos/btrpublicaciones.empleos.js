$(document).ready(function () {

    //alert("Publicaciones.empleos.js");

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_empleos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "btrpublicaciones/datatableg", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "imagen", "name": "emp.imagen" },
            { "data": "razon_social", "name": "emp.razon_social" },
            { "data": "titulo", "name": "e.titulo" },
            { "data": "region", "name": "r.descripcion" },
            { "data": "distrito", "name": "d.descripcion" },
            { "data": "cargod", "name": "c.nombres" },
            // {"data": "tipocontrato", "name": "tc.descripcion"},
            // {"data": "jornadad", "name": "j.descripcion"}, 
            { "data": "fecha_creacion", "name": "e.fecha_creacion" },
            { "data": "fecha_clausura", "name": "e.fecha_clausura" },
            { "data": "postulo", "name": "postulo", "searchable": false, "orderable": false },
            { "data": "numero_visitas", "name": "e.numero_visitas" }],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_empleos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {
            //if( data.tipo_inquilino_id == "1") {  
            var html = "";
            if (data.postulo > 0) {
                html = "<a role='button' class='btn btn-xs btn-info' href='" + base_url + "btrpublicaciones/postulantes/" + data.id_empleo + "' > " + data.postulo + " <i class='fa fa-eye' ></i></a>";
            } else {
                html = "0";
            }
            $('td', row).eq(9).html(html);


            var html2 = "<img src='" + base_url + "adminpanel/imagenes/empresas/" + data.imagen + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html2);


            var fecha_split_creacion = data.fecha_creacion;
            var fecha_split_1_creacion = fecha_split_creacion.split(" ");
            var fecha_split_2_creacion = fecha_split_1_creacion[0].split("-");
            var fecha_creacion = fecha_split_2_creacion[2] + '/' + fecha_split_2_creacion[1] + '/' + fecha_split_2_creacion[0];
            $('td', row).eq(7).html(fecha_creacion);

            var fecha_split_clausura = data.fecha_clausura;
            var fecha_split_1_clausura = fecha_split_clausura.split(" ");
            var fecha_split_2_clausura = fecha_split_1_clausura[0].split("-");
            var fecha_clausura = fecha_split_2_clausura[2] + '/' + fecha_split_2_clausura[1] + '/' + fecha_split_2_clausura[0];
            $('td', row).eq(8).html(fecha_clausura);


            //}else{
            //     $('td', row).eq(7).html('<button onclick="anadirrep('+data.id+')" class="btn btn-xs btn-info" title="añadir representante" ><i class="fa fa-user"></i></button>');
            // }
        }
    }
    );


    //reportes
    $("#form_reportes").dialog({
        autoOpen: false,
        //height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i>Reportes </h4></div>",
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
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    $("#form_reportes_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Exportar</h4></div>",
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


//reportes
function reportes() {
    $(".errorforms").hide();
    $("#form_reportes")[0].reset();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
        $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

        var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
        $("#input-fecha_fin_pdf").val(fecha_fin_pdf);

        $("#form_reportes").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}

//reporte_btrpublicaciones
function reporte_btrpublicaciones() {
    //window.open(base_url + "reportes/reportebtrpublicacionesempleos");
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
        //console.log("Testing");
        var fecha_inicio1 = $("#input-fecha_inicio_pdf").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);

        var fecha_fin1 = $("#input-fecha_fin_pdf").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);

        //var id_personal = $("#input-id_personal").val();

        window.open(base_url + "reportes/reportebtrpublicacionesempleos/" + fecha_inicio + "/" + fecha_fin);
    }
}

//reporte_btrpublicaciones_postulantes
function reporte_btrpublicaciones_postulantes() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.open(base_url + "reportes/reporteBtrpublicacionesPostulantesEmpleos/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

//exportar
function exportar() {
    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();
        var fecha_inicio_xls = moment().format('DD/MM/YYYY');
        $("#input-fecha_inicio_xls").val(fecha_inicio_xls);

        var fecha_fin_xls = moment().add(1, 'months').format('DD/MM/YYYY');
        $("#input-fecha_fin_xls").val(fecha_fin_xls);
        $("#form_reportes_xls").dialog("open");

    } else {
        errordialogtablecuriosity();
    }

}

function reporte_btrpublicaciones_xls() {
    //window.open(base_url + "reportes/reportebtrpublicaciones");
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
        //console.log("Testing");
        var fecha_inicio1 = $("#input-fecha_inicio_xls").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);

        var fecha_fin1 = $("#input-fecha_fin_xls").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);

        //var id_personal = $("#input-id_personal").val();

        window.open(base_url + "exportar/reporteBtrpublicacionesEmpleos/" + fecha_inicio + "/" + fecha_fin);
    }

}


//reporte_btrpublicaciones_postulantes
function reporte_btrpublicaciones_postulantes_xls() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.open(base_url + "exportar/reporteBtrpublicacionesPostulantesEmpleos/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}