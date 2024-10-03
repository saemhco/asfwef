$(document).ready(function () {

    //console.log(id_grupo)
    //alert("Hola Mundo");

//    var editor = CKEDITOR.replace('descripcion_ckeditor', {
//        // Define the toolbar groups as it is a more accessible solution.
//        toolbar_Basic: [
//            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
//            {name: 'styles', items: ['Format', 'Font', 'FontSize']},
//            {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
//            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
//            {name: 'document', items: ['Source']}
//        ],
//        toolbar_Full: [
//            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
//            {name: 'styles', items: ['Format', 'Font', 'FontSize']},
//            {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
//            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
//            {name: 'document', items: ['Source']}
//        ],
//        toolbar: 'Full',
//        //alto texarea ckeditor
//        height: '150px'
//    });
console.log(id_grupo);
    if (id_grupo !== 0 && id_tipo_usuario !== 0) {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        tbl_grupos_detalles = $("#tbl_grupos_detalles").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "registrogrupos/datatableGruposDetalles/" + id_grupo+"/"+id_tipo_usuario, "type": "POST"},
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
                {"data": "nombre_personal", "name": "nombre_personal"}
//                {"data": "nombre_grupo", "name": "nombre_grupo"},
//                {"data": "estado", "name": "estado"}
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_grupos_detalles'), breakpointDefinition);
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
                } else if (data.estado === 'X' || data.estado === 'I') {
                    html_estado = '<span class="label label-warning">INACTIVO</span>';
                }
                $('td', row).eq(2).html(html_estado);



            }
        });

    }



    $("#form_grupos_detalles").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5),
        maxWidth: 600,
        //height: 'auto',
        height: 450,
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registrar Personal</h4></div>",
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
                    //
                    $(".errorforms").hide();

                    var personal = $("#input-personal").val();
                    var personal_oculto = $("#input-personal_oculto").val();
                    var grupo = $("#input-grupo").val();

                    $.ajax({
                        url: base_url + "registrogrupos/getAjaxValidarUsuario",
                        type: 'POST',
                        data: {personal: personal, personal_oculto: personal_oculto, grupo: grupo},
                        success: function (msg) {

                            if (msg.say === "existe") {
                                //$('#tbl_autores').dataTable().fnDraw();
                                console.log("No puede insertar");
                                var warning = '<div class="text-danger errorforms">Usuario ya registrado...</div>';
                                $("#input-warning").after(warning);
                                //window.location.href = base_url + "formatos1/registro/" + xsmart;
                            } else if (msg.say === "editar" || msg.say === "no_existe") {

                                //frm = $("#form_servicios");  
                                frmx = $("#form_grupos_detalles");
                                //var frm = new FormData(this);
                                var frm = new FormData(document.getElementById("form_grupos_detalles"));
                                //frm.append('descripcion', editor.getData());

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

                                            $('#tbl_grupos_detalles').dataTable().fnDraw();
                                            bootbox.alert("<strong>Se registró correctamente</strong>");
                                            $("#form_grupos_detalles").dialog("close");



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
                        }
                    });
                    //

                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    //valida enter
    $("#form_servicios .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar_grupos_detalles() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $('#input-personal').val(0);
    $('#input-personal').select2({
        dropdownParent: $('#form_grupos_detalles')
    });
    $(".form_grupos_detalles").remove();
    $("#input-id_personal_grupo").val("");
    $("#input-personal_oculto").val("");
    $("#form_grupos_detalles")[0].reset();
    $("#input-estado_servicios_archivos").prop("checked", true);
    //CKEDITOR.instances['input-descripcion'].setData('');
    $("#form_grupos_detalles").dialog("open");

}

function editar_grupos_detalles() {
    $('#input-personal').select2({
        dropdownParent: $('#form_grupos_detalles')
    });
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $(".form_grupos_detalles").remove();
        $.ajax({
            type: 'POST',
            url: base_url + "registrogrupos/getAjaxGruposDetalles",
            data: {id_personal_grupo: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)

                    $("#input-" + i).val(val);
                    if (i === "personal") {
                        $('#input-personal').val(val).trigger('change');
                        $('#input-personal_oculto').val(val);
                    }



                });

                //Formateamos fecha de nacimiento
//                var f_i = $("#input-fecha").val();
//                var r_f_i = f_i.split(" ");
//                var res_f_i = r_f_i[0].split("-");
//                var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
//                $("#input-fecha").val(result_fi);

                //archivo_detalle


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_grupos_detalles").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar_grupos_detalles() {
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
                            url: base_url + "registrogrupos/eliminarGruposDetalles",
                            type: 'POST',
                            data: {"id_personal_grupo": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_grupos_detalles').dataTable().fnDraw();
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