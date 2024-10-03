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
    tbl_docprocesos = $("#tbl_docprocesos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registrodedocprocesos/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        'columnDefs': [
            {
                "targets": 2,
                "className": "text-center"
            }],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "tipo_proceso", "name": "tipo_proceso"},            
            {"data": "p_proceso", "name": "p_proceso"},            
            {"data": "desc_proceso", "name": "desc_proceso"},            
            {"data": "titulo", "name": "titulo"},            
            {"data": "archivo", "name": "archivo"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_docprocesos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/docprocesos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(5).html(html2);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(html_estado);
            



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_docprocesos').dataTable().fnFilter(this.value);
                }
            });
        }
    });
    //exito datos guardados
    $("#exito_docprocesos").dialog({
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
                    window.location.href = base_url + "registrodedocprocesos";
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
                    window.location.href = base_url + "registrodedocprocesos/registro";
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
            frmx = $("#form_docprocesos");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_docprocesos"));
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
                        //window.location.href = base_url + "docprocesos";
                        $("#exito_docprocesos").dialog("open");
                        CuriositySoundError();
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
    $("#form_docprocesos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter



    $('#input-id_resolucion').select2({
        dropdownParent: $('#form_docprocesos')
    });



});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_boletin").val("");
    $("#form_docprocesos")[0].reset();
    $("#form_docprocesos").dialog("open");
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registrodedocprocesos/registro/" + xsmart;
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
                            url: base_url + "registrodedocprocesos/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_docprocesos').dataTable().fnDraw();
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