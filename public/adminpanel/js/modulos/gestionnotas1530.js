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
        "ajax": { "url": base_url + "gestionnotas1530/datatable/" + semestreax, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            { "data": "asignatura", "name": "da.asignatura" },
            { "data": "descripcion", "name": "cu.descripcion" },
            { "data": "nombre", "name": "asi.nombre" },

            { "data": "ciclo", "name": "asi.ciclo" },
            { "data": "grupo", "name": "asi.grupo" },
            { "data": "ht", "name": "asi.ht" },
            { "data": "hp", "name": "asi.hp" },
            { "data": "nombres", "name": "ac.nombres" },
            { "data": "creditos", "name": "asi.creditos" }
            //  {"data": "asignatura", "name": "da.asignatura"},
            //  {"data": "asignatura", "name": "da.asignatura"},
            //  {"data": "asignatura", "name": "da.asignatura"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_asignaturas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {
            /*
        var html = '<a target="_blank" href="'+base_url+'gestionnotas1530/registros/'+data.asignatura+'/'+semestreax+'" rote="button" class="btn btn-xs btn-warning" ><i class="fa fa-file-pdf-o" ></i></a>';
              $('td', row).eq(11).html(html);    
               

              var html22 = '<a target="_blank" href="'+base_url+'gestionnotas1530/ep1/'+data.asignatura+'/'+semestreax+'" rote="button" class="btn btn-xs btn-warning" ><i class="fa fa-file-pdf-o" ></i></a>';
              $('td', row).eq(10).html(html22);

                 var html2 = '<a  target="_blank" href="'+base_url+'gestionnotas1530/actas/'+data.asignatura+'/'+semestreax+'" rote="button" class="btn btn-xs btn-warning" ><i class="fa fa-file-pdf-o" ></i></a>';
              $('td', row).eq(12).html(html2);*/
            //            //Mostrar imagenu src='"+base_url+"webpage/assets/images/emape_asignaturas/" + data.imagen_1 + "'   width='70' height='70'  />";
            //
            //            $('td', row).eq(1).html(html);
            //
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
        window.location.href = base_url + "gestionnotas1530/index/" + sema;
    });


    $(".not").on("click", function () {
        console.log("nais");

        $(this).focus();

    });






    $("#guardar").on("click", function () {
        $(".not").removeAttr('disabled');
        frm = $("#form-notas");
        $.ajax({
            url: base_url + "gestionnotas1530/guardanotas",
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                console.log(msg);
                var result = msg;
                if (result.say === "yes") {
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


    //reporte_pdf
    $("#form_reporte_pdf").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
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

    //reporte_pdf
    $("#form_reporte_xls").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
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


});





function agregar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.location.href = base_url + "gestionnotas1530/notas/" + xsmart + "/" + semes + "/" + grupo;
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


//reporte_pdf
function reporte_pdf() {
    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        $("#form_reporte_pdf").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}

function registro_auxiliar_pdf() {
    if ($(".selrow").is(':checked')) {
        var asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

        //ar asignatura_codigo = asignatura;

        window.open(base_url + "reportes/reporteregistroauxiliar1530/" + semestre + "/" + asignatura + "/" + grupo);

    } else {
        errordialogtablecuriosity();
    }
}

function registro_auxiliar_datos_estudiantes_pdf() {
    if ($(".selrow").is(':checked')) {
        var asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

        //ar asignatura_codigo = asignatura;

        window.open(base_url + "reportes/reporteregistroauxiliardatosestudiantes/" + semestre + "/" + asignatura + "/" + grupo);

    } else {
        errordialogtablecuriosity();
    }
}

function carga_academica_pdf() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reportecargaacademica1530/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}

function acta_inicial_pdf() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reporteactainicial1530/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}

function registro_notas_pdf() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reporteregistronotas1530/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}

function acta_final_pdf() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');
        window.open(base_url + "reportes/reporteactafinal1530/" + semes + "/" + xsmart + "/" + grupo);
    } else {
        errordialogtablecuriosity();
    }
}
//fin reporte pdf


//reporte_xls
function reporte_xls() {
    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        $("#form_reporte_xls").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}

function registro_auxiliar_xls() {
    if ($(".selrow").is(':checked')) {
        var asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

        //ar asignatura_codigo = asignatura;

        window.open(base_url + "exportar/exportarregistroauxiliar1530/" + semestre + "/" + asignatura + "/" + grupo);
                                         

    } else {
        errordialogtablecuriosity();
    }
}

function registro_auxiliar_datos_estudiantes_xls() {
    if ($(".selrow").is(':checked')) {
        var asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var grupo = $('input:radio[name=selrow]:checked').attr('pk2');

// console.log(asignatura);
// console.log(semestre);
// console.log(grupo);

        window.open(base_url + "exportar/exportarRegistroAuxiliarDatosEstudiantes1530/" + semestre + "/" + asignatura + "/" + grupo);

    } else {
        errordialogtablecuriosity();
    }
}
//fin reporte excel
