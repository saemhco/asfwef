$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_asignaturas = $("#tbl_asignaturas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionnotas/datatable/" + semestreax, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            {"data": "asignatura", "name": "da.asignatura"},
            {"data": "descripcion", "name": "cu.descripcion"},
            {"data": "nombre", "name": "asi.nombre"},
            {"data": "ciclo", "name": "asi.ciclo"},
             {"data": "grupo", "name": "da.grupo"},
            {"data": "creditos", "name": "asi.creditos"},
            {"data": "nombres", "name": "ac.nombres"},
            {"data": "ht", "name": "asi.ht"},
            {"data": "hp", "name": "asi.hp"}
           

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_asignaturas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.asignatura + '" pk2="' + data.grupo + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_asignaturas').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );
    $(".activax").on("click", function () {
//console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
        $(this).addClass("active");
        $(".not").attr("disabled", "disabled");
        $("." + item).removeAttr('disabled');
    });
    $(".activ").on("click", function () {
//console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
        $(this).parent().addClass("active");
        $(".not").attr("disabled", "disabled");
        $("." + item).removeAttr('disabled');
    });
    $("#semestre").on("change", function () {
//alert("Hi");
        var sema = $(this).val();
        window.location.href = base_url + "gestionnotas/index/" + sema;
    });
    $(".not").on("click", function () {
        console.log("nais");
        $(this).focus();
    });
    $("#guardar").on("click", function () {
        $(".not").removeAttr('disabled');
        frm = $("#form-notas");
        $.ajax({
            url: base_url + "gestionnotas/guardanotas",
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                console.log(msg);
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert("<strong>Se guardo las notas correctamente</strong>");
                    //window.location.href = base_url + "";

                } else {
                    console.log("llegamos a la disco");
                    //$(".errorforms").remove();

                }
            }
        });
        $(".not").attr("disabled", "disabled");
    });
    $("#error_agregar").dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        title: "<div class='widget-header txt-color-red'><h4><i class='fa fa-warning'></i> Error ! </h4></div>",
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
                "class": "btn btn-danger btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });
});
function confignotas() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.location.href = base_url + "gestionnotas/configuracion/" + semes + "/" + xsmart + "/" + grupo;
    } else {
        errordialogtablecuriosity();
    }
}



function agregar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

        //verificar existencia
        $.ajax({
            type: 'POST',
            url: base_url + "gestionnotas/verificarconfigAjax",
            data: {asignatura: xsmart, semestre: semes, grupo: grupo},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say === "yes") {
                    window.location.href = base_url + "gestionnotas/notas/" + semes + "/" + xsmart + "/" + grupo;
                } else {
                    bootbox.alert("<strong>Se debe configurar una formula antes de asignar las notas</strong>");
                }
            }, complete: function () {
                console.log("verificando...");
            }
        });


    } else {
        errordialogtablecuriosity();
    }
}


function calculaprom(t) {
    var row = t.closest('tr');
    var p_p1 = parseFloat(row.find('.p_p1').find('.pp1').val());
    var p_p2 = parseFloat(row.find('.p_p2').find('.pp2').val());
    var p_ef = parseFloat(row.find('.p_ef').find('.pef').val());
    var xNotaFinal = 0;
    if (p_ef == 0) {
        xNotaFinal = Math.round((p_p1 + p_p2) / 2);
    } else {
        if (p_ef > 0) {
            if (p_p1 >= p_p2) {
                xNotaFinal = Math.round((p_ef + p_p1) / 2);
            } else {
                xNotaFinal = Math.round((p_ef + p_p2) / 2);
            }
        }
    }

    row.find('.p_pf').find('.ppf').val(xNotaFinal);
    console.log(xNotaFinal);
}


//reporte de carga academica
function reporte_carga_academica() {
    var semestre = semestreax;
    window.open(base_url + "reportes/reportecargaacademica/" + semestre);
}

//reporte de acta inicial
function reporte_acta_inicial() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reporteactainicial/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}

//reporte de registro de notas
function reporte_registro_notas() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reporteregistronotas/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}

//reporte de reporte acta final
function reporte_acta_final() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reporteactafinal/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}


//reporte registro uxiliar
function reporte_registro_auxiliar() {
    if ($(".selrow").is(':checked')) {
        var asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

        //ar asignatura_codigo = asignatura;

        window.open(base_url + "reportes/reporteregistroauxiliar/" + semestre + "/" + asignatura + "/" + grupo);
        
    } else {
        errordialogtablecuriosity();
    }
}


//reporte registro uxiliar xls
function reporte_registro_auxiliar_xls() {
    if ($(".selrow").is(':checked')) {
        var asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

        //ar asignatura_codigo = asignatura;

        window.open(base_url + "exportar/reporteregistroauxiliarxls/" + semestre + "/" + asignatura + "/" + grupo);
        
    } else {
        errordialogtablecuriosity();
    }
}
