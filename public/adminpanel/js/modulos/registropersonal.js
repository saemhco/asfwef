$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_personal = $("#tbl_personal").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registropersonal/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "imagen", "name": "imagen"},
            {"data": "nro_doc", "name": "nro_doc"},
            {"data": "apellidop", "name": "apellidop"},
            {"data": "apellidom", "name": "apellidom"},
            {"data": "nombres", "name": "nombres"},
            {"data": "email1", "name": "email1"},
            {"data": "fecha_nacimiento", "name": "fecha_nacimiento"},
            {"data": "direccion_actual", "name": "direccion_actual"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_personal'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html = "<img src='" + base_url + "adminpanel/imagenes/personal/" + data.imagen + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html);

            var fecha_nacimiento = data.fecha_nacimiento;

            if (fecha_nacimiento !== null) {
                //split igual explode php
                var res_fecha_na = fecha_nacimiento.split("-");
                //recorremos el array por las posiciones
                //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
                var array_2_fecha_na = res_fecha_na[2].split(" ");

                var res_fecha_na = array_2_fecha_na[0] + '/' + res_fecha_na[1] + '/' + res_fecha_na[0];
                $('td', row).eq(7).html(res_fecha_na);
            }

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(9).html(html_estado);





        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_personal').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    //exito datos guardados
    $("#exito_personal").dialog({
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
                    window.location.href = base_url + "registropersonal";
                }
            }]
    });


    $("#alerta_editar").dialog({
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
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });


//Publicar form
    $("#publicar").on("click", function () {
        $(".errorforms").remove();
        //validar personal registrado
        var nro_doc = $("#input-nro_doc").val();
        var estado_registrado = $("#input-estado_registrado").val();

        if (estado_registrado === "") {
            $.ajax({
                type: 'POST',
                url: base_url + "registropersonal/personalRegistrado",
                data: {nro_doc: nro_doc},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'yes') {

                        var val = '<div class="text-danger errorforms">El número de documento ya está registrado</div>';
                        $("#input-nro_doc").after(val);
                    } else {
                        frmx = $("#form_personal");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_docentes");
                        var frm = new FormData(document.getElementById("form_personal"));
                        //datos += "&contenido=" + encodeURIComponent(editor.getData());
                        //frm.append('texto_complementario', editor.getData());

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
                                    //window.location.href = base_url + "registropersonal";
                                    $("#exito_personal").dialog("open");

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


                }
            });
        } else {
            frmx = $("#form_personal");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_personal"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());
            //frm.append('texto_complementario', editor.getData());

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
                        //window.location.href = base_url + "registropersonal";
                        $("#exito_personal").dialog("open");
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
    $("#form_personal .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


    $('#input-id_banco').select2();


});



//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();




        $.ajax({
            url: base_url + "registropersonal/getAjaxPermiso",
            type: 'POST',
            data: {id_personal: xsmart},
            success: function (msg) {

                if (msg.say === "yes") {
                    $("#alerta_editar").dialog("open");
                    CuriositySoundError();
                } else if (msg.say === "no") {
                    window.location.href = base_url + "registropersonal/registro/" + xsmart;
                }
            }
        });



    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
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
                            url: base_url + "registropersonal/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_personal').dataTable().fnDraw();
                                } else {
                                    $('#tbl_personal').dataTable().fnDraw();
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

//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}