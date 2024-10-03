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
    tbl_dss_adquisiciones = $("#tbl_dss_adquisiciones").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registromedicamentosadquisiciones/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "tipo", "name": "tipo"},
            {"data": "fecha_adquisicion", "name": "fecha_adquisicion"},
            {"data": "descripcion", "name": "descripcion"},
            {"data": "numero_oc", "name": "numero_oc"},
            {"data": "precio", "name": "precio"},
            {"data": "observaciones", "name": "observaciones"},
            {"data": "estado", "name": "estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_dss_adquisiciones'), breakpointDefinition);
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
            $('td', row).eq(7).html(html_estado);
            



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_dss_adquisiciones').dataTable().fnFilter(this.value);
                }
            });
        }
    });
    //exito datos guardados
    $("#exito_documentos").dialog({
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
                    window.location.href = base_url + "registromedicamentosadquisiciones";
                }
            }]
    });
    //Error encuesta ya registrada para esa asignatura
    $("#error_tipo_vacio").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "registromedicamentosadquisiciones/registro";
                }
            }]
    });
//Publicar form
    $("#publicar").on("click", function () {

        var tipo = $("#input-tipo_resolucion option:selected").val();
        if (tipo === '') {

            $("#error_tipo_vacio").dialog("open");
            CuriositySoundError();
            //alert("tipo vacio");

        } else {
            frmx = $("#form_adiquisiciones");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_adiquisiciones"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());
            //frm.append('texto_muestra', editor.getData());
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
                        //bootbox.alert("<strong>Se registró correctamente</strong>");
                        //window.location.href = base_url + "documentos";
                        $("#exito_documentos").dialog("open");

                    } else {
                        console.log("llegamos a la disco");
                        $(".errorforms").remove();
                        //Mostrar mensaje error del modelo
                        $.each(result, function (i, val) {
                            $("#input-" + i).focus();
                            $("#input-" + i).after(val);
                        });
                    }
                }
            });
        }




    });
    //valida enter
    $("#form_adiquisiciones .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter



    $('#input-id_resolucion').select2({
        dropdownParent: $('#form_adiquisiciones')
    });



});


//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registromedicamentosadquisiciones/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar()
{
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
                            url: base_url + "registromedicamentosadquisiciones/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_dss_adquisiciones').dataTable().fnDraw();
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