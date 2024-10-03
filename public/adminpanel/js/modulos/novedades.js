$(document).ready(function () {

    //
    var editor = CKEDITOR.replace('descripcion_ckeditor', {
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
        toolbar: 'Full',
        //alto texarea ckeditor
        height: '150px'
    });
    //

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_novedades").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "novedades/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "imagen", "name": "imagen"},
            {"data": "titulo", "name": "titulo"},
            {"data": "descripcion", "name": "descripcion"},
            {"data": "autor", "name": "autor"},
            {"data": "fecha", "name": "fecha"},
            {"data": "estado", "name": "estado"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_novedades'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html = "<img src='" + base_url + "adminpanel/imagenes/novedades/" + data.imagen + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html);


            var fecha_split = data.fecha;
            var fecha_split_1 = fecha_split.split(" ");
            var fecha_split_2 = fecha_split_1[0].split("-");
            var fecha = fecha_split_2[2] + '/' + fecha_split_2[1] + '/' + fecha_split_2[0];
            $('td', row).eq(5).html(fecha);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(html_estado);


        }
    }
    );




    $("#form_novedades").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Novedades</h4></div>",
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

                    frmx = $("#form_novedades");
                    //var frm = new FormData(this);
                    var frm = new FormData(document.getElementById("form_novedades"));
                    frm.append('descripcion', editor.getData());

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
                                $('#tbl_novedades').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_novedades").dialog("close");
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


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_novedad").val("");
    $("#form_novedades")[0].reset();
    $("#input-estado").prop("checked", true);
    CKEDITOR.instances['input-descripcion'].setData('');
    $("#form_novedades").dialog("open");
}

function editar() {
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "novedades/getAjax",
            data: {id_novedad: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);
                    if (i === 'descripcion') {
                        CKEDITOR.instances['input-descripcion'].setData(val);
                    }
                    if (val === "A") {
                        //Usamos la propiedad prop para el check
                        //console.log("Entro aqui");
                        $("#input-" + i).prop("checked", true);

                    }
                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_novedades").dialog("open");
            }
        });
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
                            url: base_url + "novedades/eliminar",
                            type: 'POST',
                            data: {"id_novedad": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_novedades').dataTable().fnDraw();
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