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



    tbl_medios_sunedu = $("#tbl_medios_sunedu").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "Mediosverificacionsunedu/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "nombre_indicador", "name": "indicadores.nombre"},
            {"data": "nombre", "name": "medios.nombre"},
            {"data": "archivo", "name": "medios.archivo"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_medios_sunedu'), breakpointDefinition);
            }
        },
        "columnDefs": [
            {"width": "70px", "targets": 3}
        ],
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var pdf = '';
            var excel = '';
            var enlace = '';

            if (String(data.archivo).length > 9) {
                var pdf = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/medios/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";                
            } 
            if (String(data.archivo2).length > 9) {
                var excel = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/medios/" + data.archivo2 + "' >   <i class='fa fa-file-excel' ></i></a>";                
            }  
            if (String(data.enlace).length > 9) {
                var enlace = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' id='archivo_medios' href='" + data.enlace + "'  >   <i class='fa fa-link' ></i></a>";                
            } 
            
            var html = pdf + ' ' + excel + ' ' + enlace;
            
            $('td', row).eq(3).html(html);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_medios_sunedu').dataTable().fnFilter(this.value);
                }
            });
        }
    });






    //exito datos guardados
    $("#exito_medios_sunedu").dialog({
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
                    window.location.href = base_url + "mediosverificacionsunedu";
                }
            }]
    });





//Publicar form
    $("#publicar").on("click", function () {


        frmx = $("#form_medios_sunedu");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_medios_sunedu"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());

        //frm.append('compromiso', editor_compromiso.getData());
        //frm.append('compromiso_cooperante', editor_compromiso_cooperante.getData());

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
                    //window.location.href = base_url + "medios";
                    $("#exito_medios_sunedu").dialog("open");
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





    });

    //mensaje error
    $("#error_agregar").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB</h4></div>",
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
                }
            }]
    });

    //mensaje no existe archivo
    $("#archivo_no_existe").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB</h4></div>",
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
                }
            }]
    });



    //valida enter
    $("#form_medios_sunedu .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



//    $("#input-condicion").on("change", function () {
//        carga_componentes($(this).val(), 0);
//        var html = '<option value="">Indicadores</option>';
//        $("#input-indicador").html(html);
//        //alert("Testing");
//    });
//
//
//    function carga_componentes(id_condicion, param) {
//        $.post(base_url + "mediosverificacion/getComponentes", {id_condicion: id_condicion}, function (response) {
//            var html = "";
//            html = html + '<option value="">Componente</option>';
//            $.each(response, function (i, val) {
//                if (param == 0) {
//                    html = html + '<option value="' + val.id_componente + '">' + val.nombre + '</option>';
//                } else {
//                    if (val.provincia == param) {
//
//                        html = html + '<option value="' + val.id_componente + '" selected >' + val.nombre + '</option>';
//                    } else {
//                        html = html + '<option value="' + val.id_componente + '">' + val.nombre + '</option>';
//                    }
//                }
//
//            });
//
//            $("#input-componente").html(html);
//        }, "json");
//    }
//
//
//    $("#input-componente").on("change", function () {
//        carga_indicadores($("#input-componente").val(), 0);
//    });
//
//
//    function carga_indicadores(id_componente, param) {
//
//        $.post(base_url + "mediosverificacion/getIndicadores", {id_componente: id_componente}, function (response) {
//            var html = "";
//            html = html + '<option value="">Indicador</option>';
//            $.each(response, function (i, val) {
//                if (param == 0) {
//                    html = html + '<option value="' + val.id_indicador + '">' + val.nombre + '</option>';
//                } else {
//                    if (val.id_indicador == param) {
//
//                        html = html + '<option value="' + val.id_indicador + '" selected >' + val.nombre + '</option>';
//                    } else {
//                        html = html + '<option value="' + val.id_indicador + '">' + val.nombre + '</option>';
//                    }
//                }
//
//            });
//
//            $("#input-indicador").html(html);
//        }, "json");
//
//    }
//
//    $("#input-indicador").on("change", function () {
//        carga_medios($("#input-indicador").val(), 0);
//    });
//
//
//    function carga_medios(id_indicador, param) {
//
//        $.post(base_url + "mediosverificacion/getMedios", {id_indicador: id_indicador}, function (response) {
//            var html = "";
//            html = html + '<option value="">Medio</option>';
//            $.each(response, function (i, val) {
//                if (param == 0) {
//                    html = html + '<option archivo="' + val.archivo + '" proceso="' + val.proceso + '" enlace="' + val.enlace + '" descripcion="' + val.descripcion + '" nombre="' + val.nombre + '" value="' + val.id_medio + '">' + val.nombre + '</option>';
//                } else {
//                    if (val.id_medio == param) {
//
//                        html = html + '<option archivo="' + val.archivo + '" proceso="' + val.proceso + '" enlace="' + val.enlace + '" descripcion="' + val.descripcion + '" nombre="' + val.nombre + '" value="' + val.id_medio + '" selected >' + val.nombre + '</option>';
//                    } else {
//                        html = html + '<option archivo="' + val.archivo + '" proceso="' + val.proceso + '" enlace="' + val.enlace + '" descripcion="' + val.descripcion + '" nombre="' + val.nombre + '" value="' + val.id_medio + '">' + val.nombre + '</option>';
//                    }
//                }
//
//            });
//
//            $("#input-medio").html(html);
//        }, "json");
//
//    }
//
//    $("#input-medio").on("change", function () {
//
//
//
//        var input_nombre = $("#input-medio option:selected").attr("nombre");
//        console.log("input_nombre:" + input_nombre);
//        $("#input-nombre").val(input_nombre);
//
//        var input_descripcion = $("#input-medio option:selected").attr("descripcion");
//        console.log("input_nombre:" + input_descripcion);
//        $("#input-descripcion").val(input_descripcion);
//
//        var input_enlace = $("#input-medio option:selected").attr("enlace");
//        console.log("input_nombre:" + input_enlace);
//        $("#input-enlace").val(input_enlace);
//
//        var input_proceso = $("#input-medio option:selected").attr("proceso");
//        console.log("input_nombre:" + input_proceso);
//        $("#input-proceso").val(input_proceso);
//
//        var input_archivo = $("#input-medio option:selected").attr("archivo");
//        console.log("input_archivo:" + input_archivo);
//        $("#input-archivo").val(input_archivo);
//
//
//
//        $("#enlace_archivo").attr("href", base_url + "adminpanel/archivos/medios/" + input_archivo);
//
//    });



});

function getarchivos(archivo_medio) {
    //console.log(string);
    //alert(id_medio);
    //var xsmart = id_medio;

    $.ajax({
        type: 'POST',
        url: base_url + "mediosverificacionsunedu/getArchivos",
        data: {archivo_medio: archivo_medio},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {

                window.open(base_url + 'adminpanel/archivos/medios/' + response.archivo_medio_sunedu, '_blank');

            } else {

                //alert("No existe archivo");

                $("#archivo_no_existe").dialog("open");
                CuriositySoundError();

            }

            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_curriculas").dialog("open");
            //alert('Estado:' + estado);

        }
    });
}


function agregar() {
    //Limpia los errores y resetea los valores de los campos
    //$(".errorforms").hide();
    //$("#input-id_medio").val("");
    //$("#form_medios")[0].reset();
    //$("#form_medios").dialog("open");
    $("#error_agregar").dialog("open");
    CuriositySoundError();
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "mediosverificacionsunedu/registro/" + xsmart;



    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {

    $("#error_agregar").dialog("open");
    CuriositySoundError();
//    if ($(".selrow").is(':checked')) {
//        var xsmart = $('input:radio[name=selrow]:checked').val();
//        bootbox.dialog({
//            message: "<strong>¿ Desea Eliminar este registro ?</strong>",
//            title: "Confirmar",
//            buttons: {
//                success: {
//                    label: "Aceptar",
//                    className: "btn-success",
//                    callback: function () {
//                        $.ajax({
//                            url: base_url + "medios/eliminar",
//                            type: 'POST',
//                            data: {"id": xsmart},
//                            success: function (msg) {
//
//                                if (msg.say == "yes") {
//                                    $('#tbl_medios').dataTable().fnDraw();
//                                } else {
//
//                                }
//                            }
//                        });
//                    }
//                },
//                danger: {
//                    label: "Cancelar",
//                    className: "btn-danger"
//                }
//            }
//        });
//    } else {
//        errordialogtablecuriosity();
//    }
}