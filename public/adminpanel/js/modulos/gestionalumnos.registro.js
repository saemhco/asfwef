$(document).ready(function () {

    //Modal Padres
    $("#open_modal_padres").on("click", function () {
        $("#modal_padres").dialog("open");
    });



    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_alumnos = $("#tbl_alumnos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "alumnosficha/datatable/" + semestreax, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "codigo", "name": "a.codigo"},
            {"data": "carrera", "name": "ca.descripcion"},
            {"data": "apellidop", "name": "a.apellidop"},
            {"data": "apellidom", "name": "a.apellidom"},
            {"data": "nombres", "name": "a.nombres"},
            {"data": "nro_doc", "name": "a.nro_doc"},
            {"data": "codigo", "name": "a.codigo"},
            {"data": "estado", "name": "a_a.estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var pk = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" pk2="' + data.semestre + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(pk);

            var html2 = "<a role='button' class='btn btn-xs btn-info' target='_BLANK' href='" + base_url + "alumnosficha/imprime/" + data.codigo + '/' + semestreax + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(7).html(html2);
            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(8).html(html_estado);

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_alumnos').dataTable().fnFilter(this.value);
                }
            });
        }

    });


//Carga semestre seleccionado
    $("#semestre").on("change", function () {
        var sema = $(this).val();
        window.location.href = base_url + "alumnosficha/index/" + sema;
    });

    //exito datos guardados
    $("#exito_alumno").dialog({
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
                    window.location.href = base_url + "alumnosficha";
                }
            }]
    });



//Guardar Alumno
    $("#publicar").on("click", function () {
        //alert("Hola mundo");
        frmx = $("#form_alumnos");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_alumnos");
        var frm = new FormData(document.getElementById("form_alumnos"));
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
                    //window.location.href = base_url + "alumnos";
                    //});

                    $("#exito_alumno").dialog("open");
                    CuriositySoundError();

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


    //parametros
    $("#form_alumnos_semestre").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Alumnos Ficha</h4></div>",
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


                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    //mensaje error
    $("#error_agregar").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB</h4></div>",
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
                }
            }]
    });


    //Region, prvincia y distrito (ubigeo)
    $("#input-region").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo").val("");
        var html = '<option value="">Distritos</option>';
        $("#input-distrito").html(html);
    });

    $("#input-provincia").on("change", function () {
        $("#input-ubigeo").val("");
        carga_distrito($("#input-region").val(), $(this).val(), 0);
    });

    $("#input-distrito").on("change", function () {
        var c_region = $("#input-region").val();
        var c_provincia = $("#input-provincia").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo").val(concat_name);
    });

//Funcion carga provincia
    function carga_provincia(idregion, param) {

        $.post(base_url + "btrpublicaciones/getProvincias", {pk: idregion}, function (response) {
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

            $("#input-provincia").html(html);
        }, "json");

    }


//Funcion para cargar distritos
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "btrpublicaciones/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
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

            $("#input-distrito").html(html);
        }, "json");

    }

    //Region, prvincia y distrito (Lugar de procedencia)
    $("#input-region1").on("change", function () {
        carga_provincia_lp($(this).val(), 0);
        var html = '<option value="">Distrito</option>';
        $("#input-distrito1").html(html);
    });

    $("#input-provincia1").on("change", function () {
        carga_distrito_lp($("#input-region1").val(), $(this).val(), 0);
    });

    $("#input-distrito1").on("change", function () {

    });

    //Funcion para cargar provincias
    function carga_provincia_lp(idregion, param) {
        console.log("LLega parametro enviado de region: " + param);

        $.post(base_url + "btrpublicaciones/getProvincias", {pk: idregion}, function (response) {

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

            $("#input-provincia1").html(html);
        }, "json");

    }

    //Funcion para cargar distritos
    function carga_distrito_lp(idregion, idprov, param) {

        $.post(base_url + "btrpublicaciones/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
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

            $("#input-distrito1").html(html);
        }, "json");

    }

//Funcion carga edad loading
});



function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        //Agregamos el id del semestre
        var semes = $("#semestre").val();
        window.location.href = base_url + "alumnosficha/registro/" + xsmart + "/" + semes;
        ;
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
                            url: base_url + "alumnosficha/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_alumnos').dataTable().fnDraw();
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

//Modal de Padres o apoderados
function open_modal_padres() {
    $("#modal_padres").modal("show");
}


function alumnos_semestre() {
    if ($(".selrow").is(':checked')) {
        var alumno = $('input:radio[name=selrow]:checked').val();
        var semestre = $('input:radio[name=selrow]:checked').attr('pk2');

        $("#form_alumnos_semestre").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}