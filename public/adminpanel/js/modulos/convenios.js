$(document).ready(function () {


//alert("Hola Mundo");

    if (publica == "si") {

        var editor_compromiso = CKEDITOR.replace('compromiso_ckeditor', {
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
            toolbar: 'Full'
        });

        var editor_compromiso_cooperante = CKEDITOR.replace('compromiso_cooperante_ckeditor', {
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
            toolbar: 'Full'
        });

        var editor_objeto = CKEDITOR.replace('objeto_ckeditor', {
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
            toolbar: 'Full'
        });

    }


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_convenios = $("#tbl_convenios").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroconvenios/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "imagen", "name": "imagen"},
            {"data": "titulo", "name": "titulo"},           
            {"data": "entidad_cooperante", "name": "entidad_cooperante"},
            {"data": "fecha_inicio", "name": "fecha_inicio"},
            {"data": "fecha_termino", "name": "fecha_termino"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convenios'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = "<img src='" + base_url + "adminpanel/imagenes/convenios/" + data.imagen + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html);

            //fecha_inicio
            var fecha_inicio = data.fecha_inicio;
            var res_fecha_inicio = fecha_inicio.split("-");
            var array_2_fecha_inicio = res_fecha_inicio[2].split(" ");
            var res_fecha_inicio_r = array_2_fecha_inicio[0] + '/' + res_fecha_inicio[1] + '/' + res_fecha_inicio[0];
            $('td', row).eq(4).html(res_fecha_inicio_r);

            //fecha_termino
            var fecha_termino = data.fecha_termino;
            var res_fecha_termino = fecha_termino.split("-");
            var array_2_fecha_inicio = res_fecha_termino[2].split(" ");
            var res_fecha_termino_r = array_2_fecha_inicio[0] + '/' + res_fecha_termino[1] + '/' + res_fecha_termino[0];
            $('td', row).eq(5).html(res_fecha_termino_r);

            console.log(data.archivo);

            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/convenios/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(6).html(html2);

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
                    $('#tbl_convenios').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    //exito datos guardados
    $("#exito_convenios").dialog({
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
                    window.location.href = base_url + "registroconvenios";
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
                    window.location.href = base_url + "registroconvenios/registro";
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
            frmx = $("#form_convenios");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_docentes");
            var frm = new FormData(document.getElementById("form_convenios"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());

            frm.append('compromiso', editor_compromiso.getData());
            frm.append('compromiso_cooperante', editor_compromiso_cooperante.getData());
            frm.append('objeto', editor_objeto.getData());

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
                        //window.location.href = base_url + "registroconvenios";
                        $("#exito_convenios").dialog("open");
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
    $("#form_convenios .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_convenio").val("");
    $("#form_convenios")[0].reset();
    $("#form_convenios").dialog("open");
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "registroconvenios/registro/" + xsmart;



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
                            url: base_url + "registroconvenios/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_convenios').dataTable().fnDraw();
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