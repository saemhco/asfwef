$(document).ready(function () {

    //alert("Hola Mundo");
    //Ubigeo
    if (region_id !== "") {
        carga_provincia(region_id, provincia_id);
    }

    if (provincia_id !== "") {
        //console.log("loading provincia ubigeo");
        carga_distrito(region_id, provincia_id, distrito_id);
    }

    //Lugar de procedencia
    if (region1_id !== "") {
        console.log("Region: " + region1_id);
        carga_provincia_lp(region1_id, provincia1_id);
    }



    if (provincia1_id !== "") {
        console.log("Provincia: " + provincia1_id);
        console.log("Distrito: " + distrito1_id);
        //console.log("loading provincia procedencia");
        carga_distrito_lp(region1_id, provincia1_id, distrito1_id);
    }

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_postulantes = $("#tbl_postulantes").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "publicocv/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "codigo", "name": "p.codigo"},
            {"data": "apellidop", "name": "p.apellidop"},
            {"data": "apellidom", "name": "p.apellidom"},
            {"data": "nombres", "name": "p.nombres"},
            {"data": "email", "name": "p.email"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_postulantes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_postulantes').dataTable().fnFilter(this.value);
                }
            });
        }

    });


//exito datos guardados
    $("#success").dialog({
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
                    window.location.href = base_url + "publicocv";
                }
            }]
    });

//Publicar form
    $("#publicar").on("click", function () {
        $(".errorforms").remove();
        //validar si existe
        var estado_registrado = $("#input-estado_registrado").val();
        var nro_doc = $("#input-nro_doc").val();
        if (estado_registrado === "") {
            $.ajax({
                type: 'POST',
                url: base_url + "publicocv/publicoRegistrado",
                data: {nro_doc: nro_doc},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'yes') {

                        var val = '<div class="text-danger errorforms">El número de documento ya está registrado</div>';
                        $("#input-nro_doc").after(val);

                    } else {
                        //alert("Hola Mundo");        
                        frmx = $("#form_postulantes");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_postulantes");
                        var frm = new FormData(document.getElementById("form_postulantes"));
                        //datos += "&contenido=" + encodeURIComponent(editor.getData());
                        //frm.append('contenido', editor.getData());

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
                                    //bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                                    //window.location.href = base_url + "postulantes";
                                    //});

                                    $("#success").dialog("open");
                                    //CuriositySoundError();

                                } else {
                                    console.log("llegamos a la disco");
                                    $(".errorforms").remove();

                                    $.each(result, function (i, val) {

                                        console.log("campo:" + i);
                                        //console.log("valor:" + val);


                                        $("#input-" + i).focus();

                                        if (i === 'codigo') {

                                            var val = '<div class="text-danger errorforms">El campo codigo es requerido </div>';
                                            $("#input-" + i).after(val);

                                        } else {

                                            $("#input-" + i).after(val);
                                        }




                                    });
                                }
                            }
                        });
                    }

                }
            });
        } else {
            //alert("Hola Mundo");        
            frmx = $("#form_postulantes");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_postulantes");
            var frm = new FormData(document.getElementById("form_postulantes"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());
            //frm.append('contenido', editor.getData());

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
                        //bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                        //window.location.href = base_url + "postulantes";
                        //});

                        $("#success").dialog("open");
                        //CuriositySoundError();

                    } else {
                        console.log("llegamos a la disco");
                        $(".errorforms").remove();

                        $.each(result, function (i, val) {

                            console.log("campo:" + i);
                            //console.log("valor:" + val);


                            $("#input-" + i).focus();

                            if (i === 'codigo') {

                                var val = '<div class="text-danger errorforms">El campo codigo es requerido </div>';
                                $("#input-" + i).after(val);

                            } else {

                                $("#input-" + i).after(val);
                            }




                        });
                    }
                }
            });
        }
    });

    //Error asignatura
    $("#error_postulante_registrado").dialog({
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
                    window.location.href = base_url + "postulantes";
                }
            }]
    });



    //Select region ubigeo
    $("#input-region").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia ubigeo
    function carga_provincia(idregion, param) {

        $.post(base_url + "web/getProvincias", {pk: idregion}, function (response) {
            var html = "";
            html = html + '<option value="">SELECCIONE...</option>';

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
            console.log('Llega');

            $("#input-provincia").html(html);


        }, "json");

    }
    //Select provincia-(ubigeo)
    $("#input-provincia").on("change", function () {
        $("#input-ubigeo").val("");
        carga_distrito($("#input-region").val(), $(this).val(), 0);
    });

    //cara distritos ubideo
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';
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

            $("#input-distrito").html(html);
        }, "json");

    }


    $("#input-distrito").on("change", function () {
        var c_region = $("#input-region").val();
        var c_provincia = $("#input-provincia").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo").val(concat_name);
    });

    //lugar de procedencia
    $("#input-region1").on("change", function () {
        carga_provincia_lp($(this).val(), 0);
        $("#input-ubigeo1").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia1
    function carga_provincia_lp(idregion, param) {

        $.post(base_url + "web/getProvincias", {pk: idregion}, function (response) {
            var html = "";
            html = html + '<option value="">SELECCIONE...</option>';

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
            console.log('Llega');

            $("#input-provincia1").html(html);


        }, "json");

    }

    //Select provincia-(ubigeo)
    $("#input-provincia1").on("change", function () {
        $("#input-ubigeo1").val("");
        carga_distrito_lp($("#input-region1").val(), $(this).val(), 0);
    });

    //cara distritos ubideo
    function carga_distrito_lp(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';
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

            $("#input-distrito1").html(html);
        }, "json");

    }


    $("#input-distrito1").on("change", function () {
        var c_region = $("#input-region1").val();
        var c_provincia = $("#input-provincia1").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo1").val(concat_name);
    });




});




function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "publicocv/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}

function agregar() {
    $("#error_agregar").dialog("open");
    CuriositySoundError();
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
                            url: base_url + "publicocv/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_postulantes').dataTable().fnDraw();
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


function admisionregistro() {
    //alert('Hola Mundo');
    if ($(".selrow").is(':checked')) {
        var postulante = $('input:radio[name=selrow]:checked').val();
        //window.location.href = base_url + "postulantes/registro/" + xsmart;
        //ajax
        $.ajax({
            type: 'POST',
            url: base_url + "publicocv/admisionregistroPostulante",
            data: {postulante: postulante},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'yes') {


                    //$("#error_postulante_registrado").dialog("open");
                    //CuriositySoundError();
                    window.location.href = base_url + "admisionregistrofin/index/" + postulante;


                } else if (response.say === 'no') {

                    window.location.href = base_url + "admisionregistro/index/" + postulante;

                }

                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });
        //fin ajax


        //console.log("Codigo_Postulante:" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}