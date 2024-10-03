$(document).ready(function () {

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

        position: {my: 'top', at: 'top+50'},
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
                data: {"codigo": codigo, "personal": personal, "area": area, "atencion": atencion},
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

        $.post(base_url + "gestionmesadeayuda/getPersonal", {area: area}, function (response) {
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
                if (result.say === "yes")
                {

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

    $("#input-buscar").on("click", function () {
        //console.log("Testing by @KeMack");
        //input-tipo_atencion
        //input-proceso
        //input-fecha_inicio
        //input-fecha_fin


        //tipo_atencion
        if ($("#input-tipo_atencion option:selected").val() === "") {
            var tipo_atencion = "i";
        } else {
            var tipo_atencion = $("#input-tipo_atencion option:selected").val();
        }

        //proceso
        if ($("#input-proceso option:selected").val() === "") {
            var proceso = "i";
        } else {
            var proceso = $("#input-proceso option:selected").val();
        }



        //fecha_inicio
        if ($("#input-fecha_inicio").val() === "") {
            var fecha_inicio = moment();
            fecha_inicio = fecha_inicio.subtract(90, "days");
            fecha_inicio = fecha_inicio.format("YYYY-MM-DD");
            //console.log("Cuando la fecha_incio esta vacia:" +fecha_inicio);
        } else {
            var fecha_inicio = moment($("#input-fecha_inicio").val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
            //console.log("Cuando la fecha_inicio esta llena:" + fecha_inicio);
        }
        //fecha_fin
        if ($("#input-fecha_fin").val() === "") {
            var fecha_fin = moment().format('YYYY-MM-DD');
            //console.log("Cuando la fecha_fin esta vacia:" + fecha_fin);
        } else {
            var fecha_fin = moment($("#input-fecha_fin").val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
            //console.log("Cuando la fecha_fin esta llena:" + fecha_fin);
        }

        window.location.href = base_url + "gestionmesadeayuda/atenciones/" + tipo_atencion + "/" + proceso + "/" + fecha_inicio + "/" + fecha_fin;

//            $.ajax({
//                type: 'POST',
//                url: base_url + "gestionmesadeayuda/datatableAtenciones",
//                data: {"tipo_atencion": tipo_atencion, "proceso": proceso, "fecha_inicio": fecha_inicio, "fechaa_fin": fechaa_fin},
//                dataType: 'json',
//                success: function (response) {
//                    if (response.say === 'yes') {
//                        
//                         //$('#tbl_areas').dataTable().fnDraw();
//                        
//                        //console.log("Testing by @KenMack");
//                         $('#tbl_atenciones').dataTable().fnDraw();
//                    }
//
//                }, complete: function () {
//                    //$("#form_curriculas").dialog("open");
//                    //alert('Estado:' + estado);
//
//                }
//            });

    });



    $("#input-exportar_atenciones").on("click", function () {
        //console.log("Testing by @KeMack");
        //input-tipo_atencion
        //input-proceso
        //input-fecha_inicio
        //input-fecha_fin


        //tipo_atencion
        if ($("#input-tipo_atencion option:selected").val() === "") {
            var tipo_atencion = "i";
        } else {
            var tipo_atencion = $("#input-tipo_atencion option:selected").val();
        }

        //proceso
        if ($("#input-proceso option:selected").val() === "") {
            var proceso = "i";
        } else {
            var proceso = $("#input-proceso option:selected").val();
        }



        //fecha_inicio
        if ($("#input-fecha_inicio").val() === "") {
            var fecha_inicio = moment();
            fecha_inicio = fecha_inicio.subtract(90, "days");
            fecha_inicio = fecha_inicio.format("YYYY-MM-DD");
            //console.log("Cuando la fecha_incio esta vacia:" +fecha_inicio);
        } else {
            var fecha_inicio = moment($("#input-fecha_inicio").val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
            //console.log("Cuando la fecha_inicio esta llena:" + fecha_inicio);
        }
        //fecha_fin
        if ($("#input-fecha_fin").val() === "") {
            var fecha_fin = moment().format('YYYY-MM-DD');
            //console.log("Cuando la fecha_fin esta vacia:" + fecha_fin);
        } else {
            var fecha_fin = moment($("#input-fecha_fin").val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
            //console.log("Cuando la fecha_fin esta llena:" + fecha_fin);
        }

        window.location.href = base_url + "exportacion/atenciones/" + tipo_atencion + "/" + proceso + "/" + fecha_inicio + "/" + fecha_fin;

//            $.ajax({
//                type: 'POST',
//                url: base_url + "gestionmesadeayuda/datatableAtenciones",
//                data: {"tipo_atencion": tipo_atencion, "proceso": proceso, "fecha_inicio": fecha_inicio, "fechaa_fin": fechaa_fin},
//                dataType: 'json',
//                success: function (response) {
//                    if (response.say === 'yes') {
//                        
//                         //$('#tbl_areas').dataTable().fnDraw();
//                        
//                        //console.log("Testing by @KenMack");
//                         $('#tbl_atenciones').dataTable().fnDraw();
//                    }
//
//                }, complete: function () {
//                    //$("#form_curriculas").dialog("open");
//                    //alert('Estado:' + estado);
//
//                }
//            });

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
            data: {id: xsmart},
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


                    $.post(base_url + "gestionmesadeayuda/getAtencionesDetalle", {"atencion": xsmart}, function (response) {
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

                    if (response.proceso === 1) {
                        bootbox.alert("<strong>La atención está en proceso...</strong>");
                    } else if (response.proceso === 2) {
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
    $.post(base_url + "gestionmesadeayuda/getAtencionesDetalle", {"atencion": atencion}, function (response) {
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

                $.post(base_url + "gestionmesadeayuda/getAjaxPublico", {codigo: codigo}, function (response) {

                    $("#input-publico").val(response.codigo);
                    $("#input-nro_doc").val(response.nro_doc);
                    $("#input-publico_nombre").val(response.apellidop + ' ' + response.apellidom + ' ' + response.nombres);

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
    "ajax": {"url": base_url + "gestionmesadeayuda/datatablePublico", "type": "POST"},
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
        {"data": "nro_doc", "name": "nro_doc"},
        {"data": "publico", "name": "publico"}
    ],

    "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "autoWidth": true,
    "preDrawCallback": function () {
        // Initialize the responsive datatables helper once.

    },
    "createdRow": function (row, data, index) {

    },
    initComplete: function () {
        //Busqueda al dar enter
        $('div.dataTables_filter input').unbind();
        $('div.dataTables_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                $('#tbl_publico').dataTable().fnFilter(this.value);
            }
        });
    }
});