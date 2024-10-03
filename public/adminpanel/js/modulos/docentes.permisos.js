$(document).ready(function () {
    //alert('Hola');
    //inicio datatables
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_docentes_permisos = $("#tbl_docentes_permisos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "docentespermisos/datatableDocentesPermisos/" + codigo, "type": "POST"},
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
            {"data": "imagen", "name": "personal_permisos.imagen"},
            {"data": "fecha_inicio", "name": "personal_permisos.fecha_inicio"},
            {"data": "fecha_retorno", "name": "personal_permisos.fecha_retorno"},
            {"data": "motivos", "name": "personal_permisos.motivos"},
            {"data": "archivo", "name": "personal_permisos.archivo"},
            {"data": "enlace", "name": "personal_permisos.nombres.enlace"},
            {"data": "estado", "name": "personal_permisos.estado"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_docentes_permisos'), breakpointDefinition);
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
                $('td', row).eq(2).html(fecha_ini_result2);
            }

            var fecha_retorno = data.fecha_retorno;
            //console.log(fecha_retorno);
            if (fecha_retorno !== null) {
                //split igual explode php
                var fecha_ret_r1 = fecha_retorno.split(" ");
                //console.log(res_fecha_ini[0]);

                var fecha_ret_result1 = fecha_ret_r1[0].split("-");
                //console.log(fecha_ini_result1[2]);

                var fecha_ret_result2 = fecha_ret_result1[2] + '/' + fecha_ret_result1[1] + '/' + fecha_ret_result1[0];
                $('td', row).eq(3).html(fecha_ret_result2);
            }


            var html = "<img src='" + base_url + "adminpanel/imagenes/personal_permisos/" + data.imagen + "'   width='120' height='70'  />";
            $('td', row).eq(1).html(html);


            //console.log(data.archivo_detalle);
            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/personal_permisos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(5).html(html2);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(7).html(html_estado);

        }
    });
    //fin datatables
    //Formulario registro
    $("#form_docentes_permisos").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Detalle Permiso</h4></div>",
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
                    frmx = $("#form_docentes_permisos");
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

                                $('#tbl_docentes_permisos').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_docentes_permisos").dialog("close");



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
    $("#tbl_docentes_permisos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");

    $("#form_docentes_permisos")[0].reset();
    $(".form_docentes_permisos").remove();

    //check
    $("#input-estado").prop("checked", true);

    //
    $.ajax({
        type: 'POST',
        url: base_url + "docentespermisos/getNew",
        //data: {"personal": personal},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {
                //alert(response.codigo);

                $("#input-codigo").attr('value', response.codigo);

            }

            $(".errorforms").remove();
        }, complete: function () {
            //fecha actual
            let date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();

            if (month < 10) {
                //console.log(`${day}-0${month}-${year}`);
                $("#input-fecha_inicio").val(`${day}/0${month}/${year}`);
                $("#input-fecha_retorno").val(`${day}/0${month}/${year}`);
            } else {
                //console.log(`${day}-${month}-${year}`);
                $("#input-fecha_inicio").val(`${day}/${month}/${year}`);
                $("#input-fecha_retorno").val(`${day}/0${month}/${year}`);
            }
            $("#form_docentes_permisos").dialog("open");
        }
    });
    //

}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $(".form_docentes_permisos").remove();
        $.ajax({
            type: 'POST',
            url: base_url + "docentespermisos/getAjaxDocentesPermisos",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i).val(val);
                    //console.log(i);

                    //console.log("valor de i :" + i);
                    //console.log("valor de val :" + val);


                    if (i === "gocedehaber") {

                        if (val === "1") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i).prop("checked", true);

                        }
                    }

                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {



                            var valor = '<div class="alert alert-warning fade in form_docentes_permisos"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#archivo_personal_permisos_modal").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_docentes_permisos">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/personal_permisos/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#archivo_personal_permisos_modal").after(valor);
                        }
                    }



                    if (i === "imagen") {
                        //console.log("tiene imagen"+val);
                        if (val === "" || val === null) {

                            //console.log("Valor cuando esta vacio o es null:" + val);
                            var valor = '<div class="alert alert-warning fade in form_docentes_permisos"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un imagen.</div>';
                            $("#imagen_personal_permisos_modal").after(valor);

                        } else {
                            var valor = '<div class="alert alert-success fade in form_docentes_permisos">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/imagenes/personal_permisos/' + val + '" >  <i class="fa-fw fa fa-image"></i></a></div>';
                            $("#imagen_personal_permisos_modal").after(valor);

                        }
                    }



                    if (i === "fecha_inicio") {
                        //formateamos la fecha de inicio
                        var f_i = $("#input-fecha_inicio").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_inicio").val(result_fi);
                    }

                    if (i === "fecha_retorno") {
                        //formateamos la fecha de retorno
                        var f_r = $("#input-fecha_retorno").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_r = f_r.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_r = r_f_r[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fr = res_f_r[2] + '/' + res_f_r[1] + '/' + res_f_r[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_retorno").val(result_fr);
                    }



                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_docentes_permisos").dialog("open");
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
                            url: base_url + "docentespermisos/eliminarPersonalPermisos",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_docentes_permisos').dataTable().fnDraw();
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