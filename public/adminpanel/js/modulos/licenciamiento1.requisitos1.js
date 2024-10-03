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


    console.log("medio_verificacion:" + medio_verificacion);



    tbl_requisitos1 = $("#tbl_requisitos1").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "licenciamiento1/datatableRequisitos1/" + medio_verificacion, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "codigo", "name": "requisitos1.codigo" },
            { "data": "nombre", "name": "requisitos1.nombre" },
            { "data": "archivo", "name": "requisitos1.archivo" },
            { "data": "proceso", "name": "procesos.nombres" },
            { "data": "estado", "name": "requisitos1.estado" }


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_requisitos1'), breakpointDefinition);
            }
        },
        "columnDefs": [
            { "width": "80px", "targets": 3 }

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
            var archivoResolucion = "";

            console.log(data.archivo);

            if (data.archivo !== null) {
                var pdf = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/requisitos1/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            }
            if (data.archivo2 !== null) {
                var excel = "<a role='button' class='btn btn-xs btn-success' target='_BLANK' href='" + base_url + "adminpanel/archivos/requisitos1/" + data.archivo2 + "' >   <i class='fa fa-file-excel-o' ></i></a>";
            }

            //console.log("valor enlace:"+data.enlace);

            if (data.enlace !== null && data.enlace !=="#" && data.enlace !=="") {
                var enlace = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' id='archivo_medios' href='" + data.enlace + "'  >   <i class='fa fa-link' ></i></a>";
            }

            if(data.archivo_resolucion){
  
                var archivoResolucion = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/resoluciones/" + data.archivo_resolucion + "' >R</a>";

            }

            var html = pdf + ' ' + excel + ' ' + enlace +' '+archivoResolucion;


            $('td', row).eq(3).html(html);


            var proceso = "";
            if (data.proceso === 'COMPLETADO') {
                proceso = '<span class="label label-success">COMPLETADO</span>';
            } else if (data.proceso === 'EN PROCESO') {
                proceso = '<span class="label label-warning">EN PROCESO</span>';
            }
            $('td', row).eq(4).html(proceso);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);






        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_requisitos1').dataTable().fnFilter(this.value);
                }
            });
        }
    });






    //exito datos guardados
    $("#exito_requisitos1").dialog({
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
                window.location.href = base_url + "licenciamiento1/requisitos1/" + medio_verificacion;
            }
        }]
    });





    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_requisitos");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_requisitos"));
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



                if (result.say === "yes") {
                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "medios";

                    $("#exito_requisitos1").dialog("open");
                    //CuriositySoundError();

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

    //modal caracter 1
    $("#modal_caracter_1").dialog({
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
                $('#input-id_medio_verificacion1').focus();
            }
        }]
    });

    //modal caracter 2
    $("#modal_caracter_2").dialog({
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
    $("#form_requisitos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#input-condicion").on("change", function () {
        carga_componentes($(this).val(), 0);
        var html = '<option value="">Indicadores</option>';
        $("#input-indicador1").html(html);
        //alert("Testing");
    });


    function carga_componentes(id_condicion1, param) {
        $.post(base_url + "licenciamiento1/getComponentes", { condicion1: id_condicion1 }, function (response) {
            var html = "";
            html = html + '<option value="">Componente</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.id_componente1 + '">' + val.nombre + '</option>';
                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.id_componente1 + '" selected >' + val.nombre + '</option>';
                    } else {
                        html = html + '<option value="' + val.id_componente1 + '">' + val.nombre + '</option>';
                    }
                }

            });

            $("#input-componente").html(html);
        }, "json");
    }



    $("#input-componente").on("change", function () {
        carga_indicadores($("#input-componente").val(), 0);
    });


    function carga_indicadores(id_componente1, param) {

        //console.log("componente:"+id_componente);

        $.post(base_url + "licenciamiento1/getIndicadores", { componente1: id_componente1 }, function (response) {
            var html = "";
            html = html + '<option value="">Indicador</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.id_indicador1 + '">' + val.nombre + '</option>';
                } else {
                    if (val.id_indicador1 == param) {

                        html = html + '<option value="' + val.id_indicador1 + '" selected >' + val.nombre + '</option>';
                    } else {
                        html = html + '<option value="' + val.id_indicador1 + '">' + val.nombre + '</option>';
                    }
                }

            });

            $("#input-indicador1").html(html);
        }, "json");

    }


    //    $("#input-indicador1").on("change", function () {
    //        carga_medios($("#input-indicador1").val(), 0);
    //    });

    //    function carga_medios(id_indicador1, param) {
    //
    //        $.post(base_url + "licenciamiento1/getMedios", {id_indicador1: id_indicador1}, function (response) {
    //            var html = "";
    //            html = html + '<option value="">Medio</option>';
    //            $.each(response, function (i, val) {
    //                if (param == 0) {
    //                    html = html + '<option archivo="' + val.archivo + '" proceso="' + val.proceso + '" enlace="' + val.enlace + '" descripcion="' + val.descripcion + '" nombre="' + val.nombre + '" value="' + val.id_medio_verificacion1 + '">' + val.nombre + '</option>';
    //                } else {
    //                    if (val.id_medio_verificacion1 == param) {
    //
    //                        html = html + '<option archivo="' + val.archivo + '" proceso="' + val.proceso + '" enlace="' + val.enlace + '" descripcion="' + val.descripcion + '" nombre="' + val.nombre + '" value="' + val.id_medio_verificacion1 + '" selected >' + val.nombre + '</option>';
    //                    } else {
    //                        html = html + '<option archivo="' + val.archivo + '" proceso="' + val.proceso + '" enlace="' + val.enlace + '" descripcion="' + val.descripcion + '" nombre="' + val.nombre + '" value="' + val.id_medio_verificacion1 + '">' + val.nombre + '</option>';
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


    $("#input-indicador1").on("change", function () {
        //carga_medios($("#input-indicador1").val(), 0);
        var input_nombre = $("#input-indicador1 option:selected").attr("value");
        console.log("id_indicador:" + input_nombre);
        $("#input-id_medio_verificacion1").val(input_nombre + '-' + 'MV');
        $("#input-id_indicador").val(input_nombre);


    });

    //    var validar_id_medio_verificacion1 = $("#input-id_medio_verificacion1").val();
    //    if (validar_id_medio_verificacion1.length !== 10) {
    //        alert("Testing");
    //    }





    $('#input-responsable_docente').select2();

    $('#input-responsable_administrativo').select2();


    $('#input-id_resolucion').select2();



});



function getarchivos(archivo_medio) {
    //console.log(string);
    //alert(id_medio_verificacion1);
    //var xsmart = id_medio_verificacion1;

    $.ajax({
        type: 'POST',
        url: base_url + "licenciamiento1/getArchivos",
        data: { archivo_medio: archivo_medio },
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {

                window.open(base_url + 'adminpanel/archivos/medios/' + response.archivo_medio, '_blank');

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
    $(".errorforms").hide();
    $("#input-id_medio_verificacion1").val("");
    $("#form_requisitos")[0].reset();
    $("#form_requisitos").dialog("open");

    //$("#error_agregar").dialog("open");
    //CuriositySoundError();
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "licenciamiento1/registrorequisitos1/" + xsmart;



    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {

    //$("#error_agregar").dialog("open");
    //CuriositySoundError();
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
                            url: base_url + "licenciamiento1/eliminarRequisitos1",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_requisitos1').dataTable().fnDraw();
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

function detelepdf() {
    var xsmart = id;
    //alert(xsmart);
    bootbox.dialog({
        message: "<strong>¿ Está seguro que desea eliminar el documento ?</strong>",
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
                        url: base_url + "licenciamiento1/deletepdfRequisitos1",
                        type: 'POST',
                        data: { "id": xsmart },
                        success: function (msg) {

                            if (msg.say == "yes") {
                                window.location.href = base_url + "licenciamiento1/registrorequisitos1/" + id;
                            } else {

                            }
                        }
                    });
                }
            }
        }
    });

}

function deleteexcel() {
    var xsmart = id;
    bootbox.dialog({
        message: "<strong>¿ Está seguro que desea eliminar el documento ?</strong>",
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
                        url: base_url + "licenciamiento1/deleteexcelRequisitos1",
                        type: 'POST',
                        data: { "id": xsmart },
                        success: function (msg) {

                            if (msg.say == "yes") {
                                window.location.href = base_url + "licenciamiento1/registrorequisitos1/" + id;
                            } else {

                            }
                        }
                    });
                }
            }
        }
    });

}