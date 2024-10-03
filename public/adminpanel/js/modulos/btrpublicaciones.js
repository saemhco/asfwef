$(document).ready(function () {

    //alert("Publicaciones.js");

    if (publica == "si") {
        var editor = CKEDITOR.replace('requisitosxd', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [
                { "name": "basicstyles", "groups": ["basicstyles"] },
                { "name": "links", "groups": ["links"] },
                { "name": "paragraph", "groups": ["list", "blocks"] },
                { name: 'links', items: [ 'Link' ] }


            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
    }



    if (region_id !== "") {
        carga_provincia(region_id, provincia_id);
    }

    if (provincia_id !== "") {
        console.log("yes i do");
        carga_distrito(region_id, provincia_id, distrito_id);
    }

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    if (perfil_usuario === 'ADMINISTRADOR DEL SISTEMA' || perfil_usuario === 'BOLSA DE TRABAJO') {
        tbl_usuario = $("#tbl_publicaciones").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "btrpublicaciones/datatable", "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                //{"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
                { "data": "titulo", "name": "e.titulo" },
                { "data": "region", "name": "r.descripcion" },
                { "data": "distrito", "name": "d.descripcion" },
                { "data": "cargo", "name": "c.descripcion" },
                // {"data": "tipocontrato", "name": "tc.descripcion"},
                // {"data": "jornadad", "name": "j.descripcion"}, 
                { "data": "fecha_creacion", "name": "e.fecha_creacion" },
                { "data": "fecha_clausura", "name": "e.fecha_clausura" },
                { "data": "postulo", "name": "postulo", "searchable": false, "orderable": false },
                { "data": "numero_visitas", "name": "e.numero_visitas" }],
            "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_publicaciones'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {
                //console.log("id_empleo:" + data.id_empleo);
                //if( data.tipo_inquilino_id == "1") {  
                var html = "";
                if (data.postulo > 0) {
                    html = "<a role='button' class='btn btn-xs btn-info' href='" + base_url + "btrpublicaciones/postulantes/" + data.id_empleo + "' > " + data.postulo + " <i class='fa fa-eye' ></i></a>";
                } else {
                    html = "0";
                }

                $('td', row).eq(7).html(html);

                var fecha_split_creacion = data.fecha_creacion;
                var fecha_split_1_creacion = fecha_split_creacion.split(" ");
                var fecha_split_2_creacion = fecha_split_1_creacion[0].split("-");
                var fecha_creacion = fecha_split_2_creacion[2] + '/' + fecha_split_2_creacion[1] + '/' + fecha_split_2_creacion[0];
                $('td', row).eq(5).html(fecha_creacion);

                var fecha_split_clausura = data.fecha_clausura;
                var fecha_split_1_clausura = fecha_split_clausura.split(" ");
                var fecha_split_2_clausura = fecha_split_1_clausura[0].split("-");
                var fecha_clausura = fecha_split_2_clausura[2] + '/' + fecha_split_2_clausura[1] + '/' + fecha_split_2_clausura[0];
                $('td', row).eq(6).html(fecha_clausura);

            }
        });
    } else {
        tbl_usuario = $("#tbl_publicaciones").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "btrpublicaciones/datatable", "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                { "data": "titulo", "name": "e.titulo" },
                { "data": "region", "name": "r.descripcion" },
                { "data": "distrito", "name": "d.descripcion" },
                { "data": "cargo", "name": "c.descripcion" },
                // {"data": "tipocontrato", "name": "tc.descripcion"},
                // {"data": "jornadad", "name": "j.descripcion"}, 
                { "data": "fecha_creacion", "name": "e.fecha_creacion" },
                { "data": "fecha_clausura", "name": "e.fecha_clausura" },
                { "data": "postulo", "name": "postulo", "searchable": false, "orderable": false },
                { "data": "numero_visitas", "name": "e.numero_visitas" }],
            "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_publicaciones'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {
                //if( data.tipo_inquilino_id == "1") {  
                var html = "";
                if (data.postulo > 0) {
                    html = "<a role='button' class='btn btn-xs btn-info' href='" + base_url + "btrpublicaciones/postulantes/" + data.id_empleo + "' > " + data.postulo + " <i class='fa fa-eye' ></i></a>";
                } else {
                    html = "0";
                }

                $('td', row).eq(7).html(html);


                var fecha_split_creacion = data.fecha_creacion;
                var fecha_split_1_creacion = fecha_split_creacion.split(" ");
                var fecha_split_2_creacion = fecha_split_1_creacion[0].split("-");
                var fecha_creacion = fecha_split_2_creacion[2] + '/' + fecha_split_2_creacion[1] + '/' + fecha_split_2_creacion[0];
                $('td', row).eq(5).html(fecha_creacion);

                var fecha_split_clausura = data.fecha_clausura;
                var fecha_split_1_clausura = fecha_split_clausura.split(" ");
                var fecha_split_2_clausura = fecha_split_1_clausura[0].split("-");
                var fecha_clausura = fecha_split_2_clausura[2] + '/' + fecha_split_2_clausura[1] + '/' + fecha_split_2_clausura[0];
                $('td', row).eq(6).html(fecha_clausura);




            }
        });
    }



    $("#publicar").on("click", function () {

        //alert("Hola mundo");

        frm = $("#form_empleos");
        var datos = $("#form_empleos").serialize();
        datos += "&requisitos=" + encodeURIComponent(editor.getData());
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: datos,
            success: function (msg) {
                var result = msg;
                if (result.say === "yes") {
                    bootbox.alert("<strong>Se registró correctamente</strong>")
                    window.location.href = base_url + "btrpublicaciones";

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
    });

    $("#input-region_id").on("change", function () {

        //alert("Publicaciones.js");
        console.log('Khi');

        carga_provincia($(this).val(), 0);
        $("#input-ubigeo_id").val("");
        var html = '<option value="">Provincias</option>';
        $("#input-distrito_id").html(html);
    });

    $("#input-provincia_id").on("change", function () {
        $("#input-ubigeo_id").val("");
        carga_distrito($("#input-region_id").val(), $(this).val(), 0);
    });

    $("#input-distrito_id").on("change", function () {
        var c_region = $("#input-region_id").val();
        var c_provincia = $("#input-provincia_id").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo_id").val(concat_name);
    });


    //reportes
    $("#form_reportes").dialog({
        autoOpen: false,
        //height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reportes </h4></div>",
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
        close: function (event, ui) {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#form_reportes_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Exportar</h4></div>",
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


});


function carga_provincia(idregion, param) {

    $.post(base_url + "btrpublicaciones/getProvincias", { pk: idregion }, function (response) {
        var html = "";
        html = html + '<option value="">Provincias</option>';
        $.each(response, function (i, val) {
            if (param == 0) {
                html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
            } else {
                if (val.provincia == param) {

                    html = html + '<option value="' + val.provincia + '" selected >' + val.descripcion + '</option>';
                } else {
                    html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                }
            }

        });

        $("#input-provincia_id").html(html);
    }, "json");

}

function carga_distrito(idregion, idprov, param) {

    $.post(base_url + "btrpublicaciones/getDistritos", { pk: idregion, idprov: idprov }, function (response) {
        var html = "";
        html = html + '<option value="">Distrito</option>';
        $.each(response, function (i, val) {
            if (param == 0) {
                html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
            } else {
                if (val.distrito == param) {

                    html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                } else {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                }
            }

        });

        $("#input-distrito_id").html(html);
    }, "json");

}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "btrpublicaciones/registro/" + xsmart;
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
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "btrpublicaciones/eliminar",
                            type: 'POST',
                            data: { "id_empleo": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_publicaciones').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

//reportes
function reportes() {
    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
        $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

        var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
        $("#input-fecha_fin_pdf").val(fecha_fin_pdf);




        $("#form_reportes").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}



//reporte_btrpublicaciones
function reporte_btrpublicaciones_pdf() {
    // console.log("Llega");
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
        //console.log("Testing");
        var fecha_inicio1 = $("#input-fecha_inicio_pdf").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);

        var fecha_fin1 = $("#input-fecha_fin_pdf").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);

        //var id_personal = $("#input-id_personal").val();

        window.open(base_url + "reportes/reportebtrpublicaciones/" + fecha_inicio + "/" + fecha_fin);
    }

}

//reporte_btrpublicaciones_postulantes
function reporte_btrpublicaciones_postulantes_pdf() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.open(base_url + "reportes/reporteBtrpublicacionesPostulantes/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

function exportar() {
    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        var fecha_inicio_xls = moment().format('DD/MM/YYYY');
        $("#input-fecha_inicio_xls").val(fecha_inicio_xls);

        var fecha_fin_xls = moment().add(1, 'months').format('DD/MM/YYYY');
        $("#input-fecha_fin_xls").val(fecha_fin_xls);



        $("#form_reportes_xls").dialog("open");

    } else {
        errordialogtablecuriosity();
    }

}

function reporte_btrpublicaciones_xls() {
    //window.open(base_url + "reportes/reportebtrpublicaciones");
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
        //console.log("Testing");
        var fecha_inicio1 = $("#input-fecha_inicio_xls").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);

        var fecha_fin1 = $("#input-fecha_fin_xls").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);

        //var id_personal = $("#input-id_personal").val();

        window.open(base_url + "exportar/reporteBtrpublicaciones/" + fecha_inicio + "/" + fecha_fin);
    }

}

//reporte_btrpublicaciones_postulantes
function reporte_btrpublicaciones_postulantes_xls() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.open(base_url + "exportar/reporteBtrpublicacionesPostulantes/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}