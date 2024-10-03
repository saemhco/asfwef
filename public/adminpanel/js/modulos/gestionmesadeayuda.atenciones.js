$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_atenciones = $("#tbl_atenciones").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionmesadeayuda/datatableAtenciones/" + t_a + "/" + p + "/" + f_i_d + "/" + f_f_d, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columnDefs": [
            { "targets": 9, "className": "text-center" }
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "dni", "name": "dni" },
            { "data": "publico", "name": "publico" },
            { "data": "tipo", "name": "tipo" },
            { "data": "prioridad", "name": "prioridad" },
            { "data": "fecha_recepcion", "name": "fecha_recepcion" },
            { "data": "fecha_recepcion", "name": "fecha_recepcion" },
            { "data": "fecha_inicio", "name": "fecha_inicio" },
            { "data": "fecha_termino", "name": "fecha_termino" },
            { "data": "codigo", "name": "codigo" },
            { "data": "proceso", "name": "proceso" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_atenciones'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        "createdRow": function (row, data, index) {


            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" dni="' + data.dni + '" publico="' + data.publico + '" fecha_recepcion="' + data.fecha_recepcion + '" asunto="' + data.asunto + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            //console.log(data.estado);
            var f_r = data.fecha_recepcion;
            var f_r_split1 = f_r.split(" ");
            var f_r_split2 = f_r_split1[0].split("-");
            var fecha_recepcion = f_r_split2[2] + '/' + f_r_split2[1] + '/' + f_r_split2[0];
            $('td', row).eq(5).html(fecha_recepcion);


            //console.log(data.fecha_recepcion);
            var hora = data.fecha_recepcion;
            var hora_split1 = hora.split(" ");
            var res_hora = hora_split1[1];
            $('td', row).eq(6).html(res_hora);


            if (data.fecha_inicio !== null) {
                //console.log(data.fecha_termino);
                var f_i = data.fecha_inicio;
                var f_i_split1 = f_i.split(" ");
                var f_i_split2 = f_i_split1[0].split("-");
                var fecha_inicio = f_i_split2[2] + '/' + f_i_split2[1] + '/' + f_i_split2[0];
                $('td', row).eq(7).html(fecha_inicio);
            }

            if (data.fecha_termino !== null) {
                //console.log(data.fecha_termino);
                var f_t = data.fecha_termino;
                var f_t_split1 = f_t.split(" ");
                var f_t_split2 = f_t_split1[0].split("-");
                var fecha_termino = f_t_split2[2] + '/' + f_t_split2[1] + '/' + f_t_split2[0];
                $('td', row).eq(8).html(fecha_termino);
            }

            //personal
            var personal = "";
            var personal = "<button onclick='personal(" + data.codigo + ")' class='btn btn-xs btn-primary' ><i class='fa fa-user'></i></button>";
            $('td', row).eq(9).html(personal);

            var proceso = "";
            if (data.proceso === 1) {
                proceso = '<span class="label label-warning">Solicitud</span>';
            } else if (data.proceso === 2) {
                proceso = '<span class="label label-success">En Proceso</span>';
            } else if (data.proceso === 3) {
                proceso = '<span class="label label-success">Finalizado</span>';
            } else if (data.proceso === 4) {
                proceso = '<span class="label label-success">Derivado</span>';
            }

            $('td', row).eq(10).html(proceso);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_atenciones').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    //valida enter
    $("#form_atenciones .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;

        }
    }); // fin validar enter



    //form_atenciones
    $("#form_atenciones").dialog({
        //evento cerrar boton icono .dialog
        create: function () {
            $(this).closest('div.ui-dialog')
                .find('.ui-dialog-titlebar-close')
                .click(function (e) {
                    //console.log('Testing by @KenMack');
                    $('#tbl_atenciones').dataTable().fnDraw();
                    e.preventDefault();
                });
        },
        //fin-evento boton icono

        //evento close .dialog
        closeOnEscape: true,
        close: function (event, ui) {

            if (event.originalEvent) {
                //location.reload();
                $('#tbl_atenciones').dataTable().fnDraw();
            }
            $(this).dialog('destroy');
        },
        //fin-evento close

        position: { my: 'top', at: 'top+50' },
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Asignación de personal para la atención</h4></div>",
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
                //$(this).dialog("close");
                location.reload();
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    //modal_area_personal
    $("#modal_area_personal").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Personal asignado para la atención</h4></div>",
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


    $("#input-agregar_personal").on("click", function () {

        //console.log("GAAAAAAAAAAAA");

        $(".errorforms").remove();

        if ($("#input-area option:selected").val() === "0" || $("#input-personal option:selected").val() === "0") {

            var val = '<div class="text-danger errorforms">Debe seleccionar un área y personal </div>';
            $("#input-personal_select").after(val);


        } else {

            //insert text
            var personal_nombre = $("#input-personal option:selected").attr("personal");
            var fecha_asignacion = moment().format('DD/MM/YYYY');
            var area_nombre = $("#input-area option:selected").attr("area_nombre");


            //insert
            var codigo = $("#input-codigo").val();
            var area = $("#input-area option:selected").val();
            var atencion = $("#input-atencion").val();
            var personal = $("#input-personal option:selected").val();

            //


            //si esta bien graba
            $.ajax({
                url: base_url + "gestionmesadeayuda/saveAtencionesDetalle",
                type: 'POST',
                data: { "codigo": codigo, "personal": personal, "area": area, "atencion": atencion },
                success: function (response) {
                    if (response.say === "yes") {

                        var html = "";
                        html = html + "<tr>";
                        html = html + "<td style='vertical-align: middle;text-align: left;'><strong>" + area_nombre + "</strong></td>";
                        html = html + "<td style='vertical-align: middle;text-align: left;'><strong>" + personal_nombre + "</strong></td>";
                        html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + fecha_asignacion + "</strong></td>";
                        html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + '-' + "</strong></td>";
                        html = html + "</tr>";
                        $("#tbody_atenciones_detalle").append(html);

                    }
                }
            });




        }

    });


    //Select region ubigeo
    $("#input-area").on("change", function () {
        //console.log("Gaaaaaaaaaaaaaaaaaaaa");
        $(".errorforms").remove();
        carga_personal($(this).val(), 0);
    });

    function carga_personal(area, param) {

        $.post(base_url + "gestionmesadeayuda/getPersonal", { area: area }, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';

            $.each(response, function (i, val) {
                if (param === 0) {

                    html = html + '<option value="' + val.codigo + '" personal="' + val.apellidop + ' ' + val.apellidom + ' ' + val.nombres + '">' + val.apellidop + ' ' + val.apellidom + ' ' + val.nombres + '</option>';

                }

            });


            $("#input-personal").html(html);


        }, "json");

    }


    //modal publico
    $("#open_modal_publico").on("click", function () {

        $("#input-nro_doc").val("");
        $("#input-publico").val("");
        $("#modal_publico").dialog("open");
    });


    $("#publicar").on("click", function () {


        frmx = $("#form_atenciones_admin");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_atenciones_admin"));
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
                if (result.say === "yes") {

                    bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                        window.location.href = base_url + "gestionmesadeayuda/atenciones";
                    });

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
        // }




    });



    //buscar  boton

    var fecha_inicio = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio").val(fecha_inicio);

    var fecha_fin = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin").val(fecha_fin);

    $("#input-buscar").on("click", function () {
        //console.log("Testing by @KeMack");


        $(".errorforms").remove();


        //tipo_atencion
        if ($("#input-tipo_atencion option:selected").val() === "") {
            var tipo_atencion = 0;
        } else {
            var tipo_atencion = $("#input-tipo_atencion option:selected").val();
        }

        //proceso
        if ($("#input-proceso option:selected").val() === "") {
            var proceso = 0;
        } else {
            var proceso = $("#input-proceso option:selected").val();
        }



        //fecha_inicio
        if ($("#input-fecha_inicio").val() === "" || $("#input-fecha_fin").val() === "") {
            //console.log("Entra Aqui");
            if ($("#input-fecha_inicio").val() === "") {
                var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
                $("#input-fecha_inicio").after(val);
            }
            if ($("#input-fecha_fin").val() === "") {
                var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
                $("#input-fecha_fin").after(val);
            }
        } else {
            var fecha_inicio1 = $("#input-fecha_inicio").val();
            fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
            console.log("fecha_incio:" + fecha_inicio);
            var fecha_fin1 = $("#input-fecha_fin").val();
            fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
            console.log("fecha_fin:" + fecha_fin);

            var responsiveHelper_dt_basic = undefined;
            $('#tbl_atenciones').DataTable().destroy();
            tbl_atenciones = $("#tbl_atenciones").DataTable({
                "stateSave": true,
                "ajax": { "url": base_url + "gestionmesadeayuda/datatableAtenciones/" + tipo_atencion + "/" + proceso + "/" + fecha_inicio + "/" + fecha_fin, "type": "POST" },
                "processing": false,
                "serverSide": true,
                "order": [[1, "asc"]],
                "columnDefs": [
                    { "targets": 9, "className": "text-center" }
                ],
                "columns": [
                    //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                    { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                    { "data": "dni", "name": "dni" },
                    { "data": "publico", "name": "publico" },
                    { "data": "tipo", "name": "tipo" },
                    { "data": "prioridad", "name": "prioridad" },
                    { "data": "fecha_recepcion", "name": "fecha_recepcion" },
                    { "data": "fecha_recepcion", "name": "fecha_recepcion" },
                    { "data": "fecha_inicio", "name": "fecha_inicio" },
                    { "data": "fecha_termino", "name": "fecha_termino" },
                    { "data": "codigo", "name": "codigo" },
                    { "data": "proceso", "name": "proceso" }
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
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_atenciones'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic.respond();
                },
                "createdRow": function (row, data, index) {


                    var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" dni="' + data.dni + '" publico="' + data.publico + '" fecha_recepcion="' + data.fecha_recepcion + '" asunto="' + data.asunto + '"><i></i> </label></center>';
                    $('td', row).eq(0).html(html);

                    //console.log(data.estado);
                    var f_r = data.fecha_recepcion;
                    var f_r_split1 = f_r.split(" ");
                    var f_r_split2 = f_r_split1[0].split("-");
                    var fecha_recepcion = f_r_split2[2] + '/' + f_r_split2[1] + '/' + f_r_split2[0];
                    $('td', row).eq(5).html(fecha_recepcion);


                    //console.log(data.fecha_recepcion);
                    var hora = data.fecha_recepcion;
                    var hora_split1 = hora.split(" ");
                    var res_hora = hora_split1[1];
                    $('td', row).eq(6).html(res_hora);


                    if (data.fecha_inicio !== null) {
                        //console.log(data.fecha_termino);
                        var f_i = data.fecha_inicio;
                        var f_i_split1 = f_i.split(" ");
                        var f_i_split2 = f_i_split1[0].split("-");
                        var fecha_inicio = f_i_split2[2] + '/' + f_i_split2[1] + '/' + f_i_split2[0];
                        $('td', row).eq(7).html(fecha_inicio);
                    }

                    if (data.fecha_termino !== null) {
                        //console.log(data.fecha_termino);
                        var f_t = data.fecha_termino;
                        var f_t_split1 = f_t.split(" ");
                        var f_t_split2 = f_t_split1[0].split("-");
                        var fecha_termino = f_t_split2[2] + '/' + f_t_split2[1] + '/' + f_t_split2[0];
                        $('td', row).eq(8).html(fecha_termino);
                    }

                    //personal
                    var personal = "";
                    var personal = "<button onclick='personal(" + data.codigo + ")' class='btn btn-xs btn-primary' ><i class='fa fa-user'></i></button>";
                    $('td', row).eq(9).html(personal);

                    var proceso = "";
                    if (data.proceso === 1) {
                        proceso = '<span class="label label-warning">Solicitud</span>';
                    } else if (data.proceso === 2) {
                        proceso = '<span class="label label-success">En Proceso</span>';
                    } else if (data.proceso === 3) {
                        proceso = '<span class="label label-success">Finalizado</span>';
                    } else if (data.proceso === 4) {
                        proceso = '<span class="label label-success">Derivado</span>';
                    }

                    $('td', row).eq(10).html(proceso);
                },
                initComplete: function () {
                    //Busqueda al dar enter
                    $('div.dataTables_filter input').unbind();
                    $('div.dataTables_filter input').bind('keyup', function (e) {
                        if (e.keyCode == 13) {
                            $('#tbl_atenciones').dataTable().fnFilter(this.value);
                        }
                    });
                }
            });
        }

    });

    $("#form_reporte_pdf").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#form_reporte_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte </h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
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
        $("#form_atenciones")[0].reset();

        var xsmart = $('input:radio[name=selrow]:checked').val();
        //comprueba si proceso de la atencion es igual a 3
        $.ajax({
            type: 'POST',
            url: base_url + "gestionmesadeayuda/getAtenciones",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                if (response.say === "yes") {

                    var numero_digitos = xsmart.length;
                    if (numero_digitos === 1) {
                        $("#input-codigo_atencion_text").text("000" + xsmart);
                    } else if (numero_digitos === 2) {
                        $("#input-codigo_atencion_text").text("00" + xsmart);
                    } else if (numero_digitos === 3) {
                        $("#input-codigo_atencion_text").text("0" + xsmart);
                    } else if (numero_digitos === 4) {
                        $("#input-codigo_atencion_text").text(xsmart);
                    }

                    var dni = $('input:radio[name=selrow]:checked').attr('dni');
                    var publico = $('input:radio[name=selrow]:checked').attr('publico');
                    var fecha_recepcion = $('input:radio[name=selrow]:checked').attr('fecha_recepcion');
                    var res_fecha_recepcion = fecha_recepcion.split(" ");
                    var array_2_fecha_recepcion = res_fecha_recepcion[0].split("-");

                    //console.log(array_2_fecha_recepcion);

                    var res_fecha_recepcion = array_2_fecha_recepcion[2] + '/' + array_2_fecha_recepcion[1] + '/' + array_2_fecha_recepcion[0];


                    var asunto = $('input:radio[name=selrow]:checked').attr('asunto');

                    $("#input-atencion").val(xsmart);
                    $("#input-dni").text(dni);
                    $("#input-publico").text(publico);
                    $("#input-fecha_recepcion").text(res_fecha_recepcion);
                    $("#input-asunto").text(asunto);


                    $.post(base_url + "gestionmesadeayuda/getAtencionesDetalle", { "atencion": xsmart }, function (response) {
                        var html = "";
                        //html = html + '<option value="">Provincias</option>';
                        $.each(response, function (i, val) {

                            if (val.fecha_respuesta === null) {
                                var fecha_respuesta = '';
                            } else {
                                var fecha_respuesta = moment(val.fecha_respuesta).format('DD/MM/YYYY');
                            }

                            var fecha_asignacion = moment(val.fecha_asignacion).format('DD/MM/YYYY');

                            html = html + "<tr>";
                            html = html + "<td style='vertical-align: middle;text-align: left;'><strong>" + val.area + "</strong></td>";
                            html = html + "<td style='vertical-align: middle;text-align: left;'><strong>" + val.apellidop + ' ' + val.apellidom + ' ' + val.nombres + "</strong></td>";
                            html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + fecha_asignacion + "</strong></td>";
                            html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + fecha_respuesta + "</strong></td>";
                            html = html + "</tr>";


                        });

                        $("#tbody_atenciones_detalle").html(html);
                    }, "json");
                    $("#form_atenciones").dialog("open");


                } else if (response.say === "no") {

                    if (response.proceso === 2) {

                        bootbox.alert("<strong>La atención está en proceso...</strong>");

                    } else if (response.proceso === 3) {

                        bootbox.alert("<strong>La atención a finalizado, no se puede asignar personal...</strong>");

                    }


                }
            }
        });

    } else {
        errordialogtablecuriosity();
    }
}

function personal(atencion) {
    $.post(base_url + "gestionmesadeayuda/getAtencionesDetalle", { "atencion": atencion }, function (response) {
        var html = "";
        //html = html + '<option value="">Provincias</option>';
        $.each(response, function (i, val) {

            html = html + "<tr>";
            html = html + "<td style='vertical-align: middle;text-align: left;'><strong>" + val.area + "</strong></td>";
            html = html + "<td style='vertical-align: middle;text-align: left;'><strong>" + val.apellidop + ' ' + val.apellidom + ' ' + val.nombres + "</strong></td>";
            html = html + "</tr>";

        });

        $("#tbody_atenciones_area_personal").html(html);

    }, "json");


    $("#modal_area_personal").dialog("open");

}


$("#modal_publico").dialog({
    autoOpen: false,
    //height: "auto",
    width: "820px",
    resizable: false,
    modal: true,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Seleccionar Usuario</h4></div>",
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
    }, {
        //le agregas  "id","graba" Para validar lo del enter
        html: "<i class='fa fa-check'></i>&nbsp; Seleccionar", "id": "graba",
        "class": "btn btn-info",
        click: function () {

            var codigo = $('input:radio[name=selrow]:checked').val();

            $.post(base_url + "gestionmesadeayuda/getAjaxPublico", { codigo: codigo }, function (response) {

                $("#input-publico").val(response.codigo);
                $("#input-nro_doc").val(response.nro_doc);
                $("#input-publico_nombre").val(response.apellidom + ' ' + response.apellidop + ' ' + response.nombres);

            }, 'json');

            $("#modal_publico").dialog("close");

        }
    }],
    close: function () {
        $("#modal_publico").dialog("close");
    }
});

//datatables de lectores
var tbl_publico = $("#tbl_publico");
tbl_publico.DataTable({
    "ajax": { "url": base_url + "gestionmesadeayuda/datatablePublico", "type": "POST" },
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
        { "data": "nro_doc", "name": "nro_doc" },
        { "data": "publico", "name": "publico" }
    ],

    "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "autoWidth": true,
    "preDrawCallback": function () {
        // Initialize the responsive datatables helper once.

    },
    "createdRow": function (row, data, index) {

    }
});


function reporte_pdf() {
    $(".errorforms").remove();
    $("#form_reporte_pdf")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_pdf").val(fecha_fin_pdf);

    $("#form_reporte_pdf").dialog("open");
}

function reporte_gestionmesadeayuda_pdf() {
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
        var fecha_inicio1 = $("#input-fecha_inicio_pdf").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_pdf").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);

        //tipo_atencion
        if ($("#input-tipo_atencion_pdf option:selected").val() === "") {
            var tipo_atencion = 0;
        } else {
            var tipo_atencion = $("#input-tipo_atencion_pdf option:selected").val();
        }

        //proceso
        if ($("#input-proceso_pdf option:selected").val() === "") {
            var proceso = 0;
        } else {
            var proceso = $("#input-proceso_pdf option:selected").val();
        }


        window.open(base_url + "reportes/reportegestionmesadeayudaatenciones/" + tipo_atencion + "/" + proceso + "/" + fecha_inicio + "/" + fecha_fin);
    }
}


function reporte_xls() {
    $(".errorforms").remove();
    $("#form_reporte_xls")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_xls").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_xls").val(fecha_fin_pdf);

    $("#form_reporte_xls").dialog("open");
}

function reporte_gestionmesadeayuda_xls() {
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
        var fecha_inicio1 = $("#input-fecha_inicio_xls").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_xls").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);


        //tipo_atencion
        if ($("#input-tipo_atencion_xls option:selected").val() === "") {
            var tipo_atencion = 0;
        } else {
            var tipo_atencion = $("#input-tipo_atencion_xls option:selected").val();
        }

        //proceso
        if ($("#input-proceso_xls option:selected").val() === "") {
            var proceso = 0;
        } else {
            var proceso = $("#input-proceso_xls option:selected").val();
        }

        window.open(base_url + "exportar/exportargestionmesadeayudaatenciones/" + tipo_atencion + "/" + proceso + "/" + fecha_inicio + "/" + fecha_fin);
    }
}
