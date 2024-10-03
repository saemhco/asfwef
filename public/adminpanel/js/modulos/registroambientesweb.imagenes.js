$(document).ready(function () {

    //
    /*
     var editor = CKEDITOR.replace('descripcionambientes_imagenes_ckeditor', {
     // Define the toolbar groups as it is a more accessible solution.
     toolbar_Basic: [
     {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
     {name: 'styles', items: ['Format', 'Font', 'FontSize']},
     {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
     {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
     {name: 'document', items: ['Source']}
     ],
     toolbar_Full: [
     {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
     {name: 'styles', items: ['Format', 'Font', 'FontSize']},
     {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
     {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
     {name: 'document', items: ['Source']}
     ],
     toolbar: 'Full',
     height: '130px'
     //width: '500px'
     });
     */
    //
    if (id_ambiente_js !== 0) {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        tbl_ambientes_imagenes = $("#tbl_ambientes_imagenes").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "registroambientesweb/datatableAmbientesImagenes/" + id_ambiente_js, "type": "POST"},
            "processing": false,
            "serverSide": true,
            //Desactivamos buscador
            //"searching": false,
            //Desactivamos Show inicio
            "lengthChange": false,
            'columnDefs': [
                {
                    "targets": 0,
                    "className": "text-center"
                }],
            "order": [[1, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                {"data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false},
                {"data": "imagen", "name": "ambientes_imagenes.imagen"},
                {"data": "titular", "name": "ambientes_imagenes.titular"},
                {"data": "fecha_hora", "name": "ambientes_imagenes.fecha_hora"},
                {"data": "enlace", "name": "ambientes_imagenes.enlace"},
                {"data": "estado", "name": "ambientes_imagenes.estado"}
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_ambientes_imagenes'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {

                var html = "<img src='" + base_url + "adminpanel/imagenes/ambientes_img/" + data.imagen + "'   width='90' height='60'  />";
                $('td', row).eq(1).html(html);

                //Formateamos la fecha
                var fecha_hora = data.fecha_hora;
                //split igual explode php
                var res_fecha_hora = fecha_hora.split("-");
                //recorremos el array por las posiciones
                //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
                var array_2_fecha_inicio = res_fecha_hora[2].split(" ");

                var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
                $('td', row).eq(3).html(res_fecha_hora);


                var html_estado = "";
                if (data.estado === 'A') {
                    html_estado = '<span class="label label-success">ACTIVO</span>';
                } else if (data.estado === 'X') {
                    html_estado = '<span class="label label-warning">INACTIVO</span>';
                }
                $('td', row).eq(5).html(html_estado);


            }
        });

    }




    $("#form_ambientes_imagenes").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Imagenes</h4></div>",
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
                html: "<i class='fa fa-save'></i>&nbsp; Grabar", "id": "graba",
                "class": "btn btn-info",
                click: function () {
                    //frm = $("#form_ambientes");  
                    frmx = $("#form_ambientes_imagenes");

                    var frm = new FormData(document.getElementById("form_ambientes_imagenes"));
                    //frm.append('descripcionambientes_imagenes', editor.getData());

                    //var frm = new FormData(this);

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

                                $('#tbl_ambientes_imagenes').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_ambientes_imagenes").dialog("close");



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
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    //valida enter
    $("#form_ambientes .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar_ambientes_imagenes() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $("#input-id_ambiente_imagen").val("");
    $("#form_ambientes_imagenes")[0].reset();
     $("#input-estado_ambientes_imagenes").prop("checked", true);
    $("#form_ambientes_imagenes").dialog("open");


    //fecha actual
    let date = new Date();

    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    if (month < 10) {
        //console.log(`${day}-0${month}-${year}`);
        $("#input-fecha_horaambientes_imagenes").val(`${day}/0${month}/${year}`);
    } else {
        //console.log(`${day}-${month}-${year}`);
        $("#input-fecha_horaambientes_imagenes").val(`${day}/${month}/${year}`);
    }
    $("#input-estadoambientes_imagenes").prop("checked", true);

}

function editar_ambientes_imagenes() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registroambientesweb/getAjaxAmbientesImagenes",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)

                    if (i === "id_ambiente_imagen") {
                        $("#input-id_ambiente_imagen").val(val);
                    }

                    if (i === "titular") {

                        $("#input-titular_ambientes_imagenes").val(val);
                    }

                    if (i === "enlace") {

                        $("#input-enlace_ambientes_imagenes").val(val);
                    }


                    if (i === "descripcion") {

                        $("#input-descripcion_ambientes_imagenes").val(val);
                    }


                    if (i === "estado") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i + "_ambientes_imagenes").prop("checked", true);

                        }
                    }

                    if (i === "fecha_hora") {
                        console.log(val);
                        //Formateamos fecha de nacimiento
                        var f_i = val;
                        console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log(result_fi);
                        $("#input-fecha_hora_ambientes_imagenes").val(result_fi);
                    }



                });






                $("#imagen_ambientes_imagenes").val("");


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_ambientes_imagenes").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar_ambientes_imagenes() {
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
                            url: base_url + "registroambientesweb/eliminarAmbientesImagenes",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_ambientes_imagenes').dataTable().fnDraw();
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