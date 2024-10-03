$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_convocatorias = $("#tbl_convocatorias").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionconvocatorias/datatableConvocatorias2", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columnDefs": [
            { "width": "70px", "targets": 3 },
            { "width": "250px", "targets": 4 }
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "fecha_hora", "name": "convocatorias.fecha_hora" },
            { "data": "titulo", "name": "convocatorias.titulo" },
            { "data": "nombre_corto", "name": "convocatorias_perfiles.nombre_corto" },
            { "data": "nombre", "name": "convocatorias_perfiles.nombre" },
            { "data": "id_convocatoria", "name": "convocatorias.id_convocatoria" }],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convocatorias'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            //console.log(data.archivo);

            var fecha_hora = data.fecha_hora;

            if (fecha_hora !== null) {
                //split igual explode php
                var fecha_ini_r1 = fecha_hora.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                $('td', row).eq(1).html(fecha_ini_result2);
            }
            var postular = "";
            postular = "<button onclick='postular(" + data.id_convocatoria + "," + data.codigo + ",\"" + data.titulo + "\",\"" + data.nombre_corto + "\",\"" + data.nombre + "\",\"" + data.archivo + "\",\"" + data.fecha_inicio + "\",\"" + data.fecha_fin + "\")' class='btn btn-xs btn-success' >Postular</button>";
            $('td', row).eq(5).html(postular);



        }
    }
    );




    $("#form_convocatorias").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.6 : 0.6), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4 id='titulo_modal'></h4></div>",
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
        }, {
            //le agregas  "id","graba" Para validar lo del enter
            html: "<i class='fa fa-save'></i>&nbsp; Confirmar Postulación", "id": "graba",
            "class": "btn btn-info",
            click: function () {



                $(".errorforms").remove();

                var archivo = $("#input-file-archivo").val();
                var extensiones = archivo.substring(archivo.lastIndexOf("."));

                if (extensiones !== ".pdf") {
                    var val = '<div class="text-danger errorforms">Subir sus Anexos en formato .pdf</div>';
                    $("#input-anexos").after(val);
                } else {


                    frmx = $("#form_convocatorias");
                    var frm = new FormData(this);//Trae archivos del formulario

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
                                $('#tbl_convocatorias').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_convocatorias").dialog("close");
                            } else {
                                if (result.say === "fecha_vencida") {

                                    //console.log("La fecha ya vencido no moleste");
                                    var val = '<div class="text-danger errorforms">La postulación a finalizado</div>';
                                    $("#input-anexos").after(val);

                                } else {
                                    console.log("llegamos a la disco");
                                    $(".errorforms").remove();

                                    $.each(result, function (i, val) {
                                        //$("#input-" + i).focus();
                                        //$("#input-" + i).after(val);
                                        console.log(i);
                                        if (i === 'anexos') {
                                            $("#input-" + i).after(val);
                                        }

                                    });
                                }

                            }
                        }
                    });
                }

            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });



    $("#input-file-archivo").on("change", function () {
        //console.log("input-index-imagen");
        $("#graba").attr("disabled", false);
        $(".errorforms").remove();
        console.log("valida formato");
        var archivo = $("#input-file").val();
        var extensiones = archivo.substring(archivo.lastIndexOf("."));
        if ((extensiones != '.pdf') && (extensiones != '.PDF')) {
            $(".errorforms").remove();
            var val = '<div class="text-danger errorforms">El formato del archivo no corresponde...</div>';
            $("#input-file").after(val);
            $(this).val('');
            $("#graba").attr("disabled", true);
        }
    });


});

function postular(codigo, convocatoria_perfiles_codigo, convocatorias_titular, convocatoria_perfiles_nombre_corto, convocatoria_perfiles_nombre, convocatorias_archivo, fecha_inicio, fecha_fin) {
    //console.log("codigo:" + codigo + " - convocatoria:" + convocatoria);

    $(".errorforms").remove();

    $("#form_convocatorias")[0].reset();

    $("#titulo_modal").text();


    var publico = $("#input-publico").val();


    $("#input-convocatorias_archivo").attr('href', base_url + "adminpanel/archivos/convocatorias/" + convocatorias_archivo);

    //console.log("fecha inicio:" + fecha_inicio);
    //console.log("fecha fin:" + fecha_fin);

    var f_i = moment(fecha_inicio).format('YYYY-MM-DD HH:mm:ss');
    console.log("Fecha de Inicio:" + f_i);

    var f_f = moment(fecha_fin).format('YYYY-MM-DD HH:mm:ss');
    console.log("Fecha de Fin:" + f_f);
    //console.log("fecha actual " + dateStr);

    var f_a = moment().format('YYYY-MM-DD HH:mm:ss');
    console.log("Fecha actual:" + f_a);




    if (f_a >= f_i && f_a <= f_f) {

        

        //validar count: formacion, capacitaciones, experiencia
        //if (count_formacion > 0 && count_capacitaciones > 0 && count_experiencia > 0 && count_idiomas > 0) {
        
        //VALIDACIÓN CARGOS Y MATERIALES
        //if (count_formacion > 0 && count_capacitaciones > 0 && count_experiencia > 0 && count_cargos > 0 && count_idiomas > 0 && count_materiales > 0) {

            //alert("GAAAAAAAAAAA PUEDE POSTULAR");
            $.ajax({
                type: 'POST',
                url: base_url + "gestionconvocatorias/verificarConvocatoria2",
                data: { convocatoria: codigo, publico: publico },
                dataType: 'json',
                success: function (response) {
                    if (response.say === 'yes') {
                        bootbox.dialog({
                            message: "<strong>¿ Está seguro que desea postular a este perfil ?</strong>",
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
                                            url: base_url + "gestionconvocatorias/saveConvocatorias2",
                                            type: 'POST',
                                            //data: {"id": xsmart},
                                            data: {"id_perfil": convocatoria_perfiles_codigo, "id_publico": publico, "convocatorias_titular": convocatorias_titular,"convocatoria_perfiles_codigo":convocatoria_perfiles_codigo,"convocatoria_perfiles_nombre":convocatoria_perfiles_nombre, "convocatoria_perfiles_nombre_corto":convocatoria_perfiles_nombre_corto},
                                            success: function (msg) {
                
                                                if (msg.say == "yes") {
                                                    $('#tbl_convocatorias').dataTable().fnDraw();
                                                }
                                            }
                                        });
                                    }
                                }
                
                            }
                        });
                    } else if(response.say === 'no'){

                        bootbox.alert("<strong>Usted ya postuló a esta convocatoria...</strong>");

                    }
                }
            });
        /*} else {
            bootbox.alert("<strong>Debe registrar formación académica, cursos / diplomados y experiencia laboral para postular...</strong>");
        }*/
        //

    } else {
        //alert("GAAAAAAAAAAA NO PUEDE POSTULAR");
        bootbox.alert("<strong>Verificar la fecha de Registro de Postulación en el Cronograma de las Bases ...</strong>");
    }
}
