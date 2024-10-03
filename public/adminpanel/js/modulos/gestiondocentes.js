$(document).ready(function () {
    //alert("Hola mundo");


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_obra = $("#tbl_docentes").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestiondocentes/datatable/" + semestreax, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            {"data": "docente", "name": "docentes_semestre.docente"},
            {"data": "apellidop", "name": "docentes.apellidop"},
            {"data": "apellidom", "name": "docentes.apellidom"},
            {"data": "nombres", "name": "docentes.nombres"},
            {"data": "nro_doc", "name": "docentes.nro_doc"},
            {"data": "celular", "name": "docentes.celular"},
            {"data": "titulo", "name": "docentes.titulo"},
            {"data": "estado", "name": "docentes_semestre.estado"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_docentes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(8).html(html_estado);





        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_docentes').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    //semestre
    $("#semestre").on("change", function () {
        var sema = $(this).val();
        window.location.href = base_url + "gestiondocentes/index/" + sema;
    });

    //exito datos guardados
    $("#guarda_docentes").dialog({
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
                    window.location.href = base_url + "gestiondocentes";
                }
            }]
    });





//Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_gestiondocentes");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_gestiondocentes");
        var frm = new FormData(document.getElementById("form_gestiondocentes"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());
        //frm.append('contenido', editor.getData());

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
                if (result.say === "yes")
                {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "docentes";
//                    });

                    $("#guarda_docentes").dialog("open");
                    CuriositySoundError();


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
    });



});



function informacion_semestral() {
    if ($(".selrow").is(':checked')) {
        var docente = $('input:radio[name=selrow]:checked').val();
        var semestre = $("#semestre option:selected").val();
        window.location.href = base_url + "gestiondocentes/registro/" + semestre + "/" + docente;
    } else {
        errordialogtablecuriosity();
    }
}
