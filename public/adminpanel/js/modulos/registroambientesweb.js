$(document).ready(function () {


    if (publica == "si") {

        var editor = CKEDITOR.replace('texto_complementario_ckeditor', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbar_Basic: [
                {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
                {name: 'document', items: ['Source']},
                { name: 'links', items: [ 'Link' ] }
            ],
            toolbar_Full: [
                {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
                {name: 'document', items: ['Source']},
                { name: 'links', items: [ 'Link' ] }
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



    tbl_ambientes = $("#tbl_ambientes").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroambientesweb/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "imagen", "name": "imagen"},
            {"data": "titular", "name": "titular"},
            {"data": "texto_muestra", "name": "texto_muestra"},
            {"data": "fecha_hora", "name": "fecha_hora"},
            {"data": "orden", "name": "orden"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_ambientes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html = "<img src='" + base_url + "adminpanel/imagenes/ambientes/" + data.imagen + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html);


            //console.log(data.fecha_hora);
            //console.log(data.texto_muestra);
            var texto_muestra = data.texto_muestra;
            var res_texto_muestra = texto_muestra.substring(0, 100);
            //console.log(res_texto_muestra);
            $('td', row).eq(3).html(res_texto_muestra + "...");



            var fecha_hora = data.fecha_hora;
            //split igual explode php
            var res_fecha_hora = fecha_hora.split("-");
            //recorremos el array por las posiciones
            //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
            var array_2_fecha_inicio = res_fecha_hora[2].split(" ");

            var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
            $('td', row).eq(4).html(res_fecha_hora);

            $('td', row).eq(5).html(data.order);

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
                    $('#tbl_ambientes').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    //exito datos guardados
    $("#exito_ambientes").dialog({
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
                    window.location.href = base_url + "registroambientesweb";
                }
            }]
    });





//Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_ambientes");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_ambientes"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());
        frm.append('texto_complementario', editor.getData());

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
                    //window.location.href = base_url + "ambientes";
                    $("#exito_ambientes").dialog("open");
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


    //valida enter
    $("#form_ambientes .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_ambiente").val("");
    $("#form_ambientes")[0].reset();
    $("#form_ambientes").dialog("open");
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "registroambientesweb/registro/" + xsmart;



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
                            url: base_url + "registroambientesweb/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_ambientes').dataTable().fnDraw();
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