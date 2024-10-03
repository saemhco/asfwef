$(document).ready(function () {
    //alert('Hola');
    //inicio datatables

    if(id_contrato !== ""){
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;
    
        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };
    
        tbl_adenda = $("#tbl_adenda").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "registropersonal/datatableAdendas/" + id_contrato, "type": "POST"},
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
    
                {"data": "fecha_inicio", "name": "contratos_adendas.fecha_inicio"},
                {"data": "fecha_fin", "name": "contratos_adendas.fecha_fin"},
                {"data": "numero", "name": "contratos_adendas.numero"},
                {"data": "adenda", "name": "contratos_adendas.adenda"},
                {"data": "estado", "name": "contratos_adendas.estado"}
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_adenda'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {
    
                var fecha_inicio = data.fecha_inicio;
    
                if (fecha_inicio !== null) {
                    //split igual explode php
                    var fecha_ini_r1 = fecha_inicio.split(" ");
                    //console.log(res_fecha_ini[0]);
    
                    var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                    //console.log(fecha_ini_result1[2]);
    
                    var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                    $('td', row).eq(1).html(fecha_ini_result2);
                }
    
                var fecha_fin = data.fecha_fin;
                //console.log(fecha_fin);
                if (fecha_fin !== null) {
                    //split igual explode php
                    var fecha_ret_r1 = fecha_fin.split(" ");
                    //console.log(res_fecha_ini[0]);
    
                    var fecha_ret_result1 = fecha_ret_r1[0].split("-");
                    //console.log(fecha_ini_result1[2]);
    
                    var fecha_ret_result2 = fecha_ret_result1[2] + '/' + fecha_ret_result1[1] + '/' + fecha_ret_result1[0];
                    $('td', row).eq(2).html(fecha_ret_result2);
                }
    
    
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

    //
    $("#form_adenda").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro De Adenda</h4></div>",
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
                    //frm = $("#form_areass");  
                    frmx = $("#form_adenda");
                    var frm = new FormData(this);

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

                                $('#tbl_adenda').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_adenda").dialog("close");



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
    //$("#input-codigo").val("");

    $("#form_adenda")[0].reset();
    $(".form_adenda").remove();

    //
    var contrato = $("#input-contrato_adenda").val();
    var anio = $("#input-anio_adenda").val();
    //

    var contrato_text = $("#input-contrato").val();

    $.ajax({
        type: 'POST',
        url: base_url + "registropersonal/getNuevoAdendas",
        data: {"contrato": contrato, "anio": anio},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {
                //alert(response.codigo);

                $("#input-codigo_adenda").attr('value', response.codigo);

                var numero_digitos = response.numero.toString().length;

                console.log(numero_digitos);

                if (numero_digitos === 1) {
                    $("#input-adenda").val("ADENDA N°" + "000" + response.numero + " AL " + contrato_text);
                } else if (numero_digitos === 2) {
                    $("#input-adenda").val("ADENDA N°" + "00" + response.numero + " AL " + contrato_text);
                } else if (numero_digitos === 3) {
                    $("#input-adenda").val("ADENDA N°" + "0" + response.numero + " AL " + contrato_text);
                } else if (numero_digitos === 4) {
                    $("#input-adenda").val("ADENDA N°" + response.numero + "AL " + contrato_text);
                }

                $("#input-numero_adenda").attr('value', response.numero);

            }

            $(".errorforms").remove();
        }, complete: function () {

            $("#form_adenda").dialog("open");


        }
    });
    //

}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $(".form_adenda").remove();
        $.ajax({
            type: 'POST',
            url: base_url + "registropersonal/getAjaxContratosAdendas",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i + "_adenda").val(val);
                    //console.log(i);

                    if (i === 'adenda') {
                        $("#input-" + i).val(val);
                    }

                    if (i === "visado") {
                        //console.log("Valor visado:"+val);
                        if (val === "1") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i + "_adenda").prop("checked", true);

                        }
                    }

                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {



                            var valor = '<div class="alert alert-warning fade in form_adenda"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#archivo_adenda_modal").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_adenda">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/contratos_adendas/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#archivo_adenda_modal").after(valor);
                        }
                    }



                    if (i === "imagen") {
                        //console.log("tiene imagen"+val);
                        if (val === "" || val === null) {

                            //console.log("Valor cuando esta vacio o es null:" + val);
                            var valor = '<div class="alert alert-warning fade in form_adenda"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un imagen.</div>';
                            $("#imagen_adenda_modal").after(valor);

                        } else {
                            var valor = '<div class="alert alert-success fade in form_adenda">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/imagenes/contratos_adendas/' + val + '" >  <i class="fa-fw fa fa-image"></i></a></div>';
                            $("#imagen_adenda_modal").after(valor);

                        }
                    }

                    if (i === "fecha_inicio") {
                        //formateamos la fecha de inicio
                        var f_i = $("#input-fecha_inicio_adenda").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_inicio_adenda").val(result_fi);
                    }

                    if (i === "fecha_fin") {
                        //formateamos la fecha de retorno
                        var f_r = $("#input-fecha_fin_adenda").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_r = f_r.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_r = r_f_r[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fr = res_f_r[2] + '/' + res_f_r[1] + '/' + res_f_r[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_fin_adenda").val(result_fr);
                    }





                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_adenda").dialog("open");
            }
        });
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
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                },
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "registropersonal/eliminarContratosAdendas",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_adenda').dataTable().fnDraw();
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