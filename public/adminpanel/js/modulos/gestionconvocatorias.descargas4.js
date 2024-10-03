$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_web_convocatorias_descargas = $("#tbl_web_convocatorias_descargas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionconvocatorias/datatableDescargas4", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "titulo", "name": "titulo"},
            {"data": "archivo", "name": "archivo"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_web_convocatorias_descargas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/convocatorias_descargas/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(2).html(html2);

        }
    }
    );




    $("#form_tbl_web_convocatorias_descargas").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Formación Académica</h4></div>",
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
                    $(".errorforms").remove();
                    //fecha_actual
//                    Date.prototype.today = function () {
//                        return ((this.getDate() < 10) ? "0" : "") + this.getDate() + "/" + (((this.getMonth() + 1) < 10) ? "0" : "") + (this.getMonth() + 1) + "/" + this.getFullYear();
//                    };
//
//                    var fecha_actual = new Date().today();
//                    var fecha_grado = $("#input-fecha_grado").val();
//
//                    if (new Date(fecha_grado) < new Date(fecha_actual)) {
                    //alert("yes!");
                    frmx = $("#form_tbl_web_convocatorias_descargas");
                    //var frm = new FormData(this);
                    var frm = new FormData(document.getElementById("form_tbl_web_convocatorias_descargas"));
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
                                $('#tbl_web_convocatorias_descargas').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_tbl_web_convocatorias_descargas").dialog("close");
                            } else {

                                if (result.say === "falta") {
                                    var val = '<div class="text-danger errorforms">El campo archivo es requerido</div>';
                                    $("#input-archivo").after(val);
                                } else {
                                    if (result.say === "no_formato") {
                                        var val = '<div class="text-danger errorforms">Subir archivo en formato .pdf/.jpg/.jpeg</div>';
                                        $("#input-archivo").after(val);
                                    } else {
                                        console.log("llegamos a la disco");
                                        $(".errorforms").remove();

                                        $.each(result, function (i, val) {
                                            $("#input-" + i).focus();
                                            $("#input-" + i).after(val);
                                        });
                                    }
                                }
                            }
                        }
                    });
//                    } else {
//                        //alert("no!");
//                        var val = '<div class="text-danger errorforms">Especificar una fecha menor a la fecha actual</div>';
//                        $("#input-fecha_grado").after(val);
//                    }



                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    // $("#form_tbl_web_convocatorias_descargas")[0].reset();
    // $(".form_tbl_web_convocatorias_descargas").remove();
    // $("#input-file").attr("value", "");
    // $("#input-estado").prop("checked", true);
    // $("#input-codigo").val("");
    // $("#form_tbl_web_convocatorias_descargas").dialog("open");
}

function editar() {
    if ($(".selrow").is(':checked')) {
        // $(".form_tbl_web_convocatorias_descargas").remove();
        //  $("#form_tbl_web_convocatorias_descargas")[0].reset();
        //  $("#input-file").attr("value", "");
        // var xsmart = $('input:radio[name=selrow]:checked').val();
        // $.ajax({
        //     type: 'POST',
        //     url: base_url + "gestionconvocatorias/getAjaxPublicoFormacion",
        //     data: {id: xsmart},
        //     dataType: 'json',
        //     success: function (response) {
        //         //var result = JSON.parse(msg);
        //         $.each(response, function (i, val) {
        //             $("#input-" + i).val(val);

        //             if (i === "fecha_grado") {
        //                 //formateamos la fecha de inicio
        //                 var f_i = $("#input-fecha_grado").val();
        //                 //console.log(f_i);
        //                 //Split igual explode php
        //                 var r_f_i = f_i.split(" ");
        //                 //console.log(r_f_i[0]);
        //                 var res_f_i = r_f_i[0].split("-");
        //                 //console.log(res_f_i[0]);
        //                 var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
        //                 //console.log("Fecha de inicio:" + result_fi);
        //                 $("#input-fecha_grado").val(result_fi);
        //             }

        //             if (i === "archivo") {
        //                 //console.log("tiene archivo"+val);
        //                 if (val === "" || val === null) {



        //                     var valor = '<div class="alert alert-warning fade in form_tbl_web_convocatorias_descargas"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
        //                     $("#input-archivo").after(valor);
        //                 } else {
        //                     //
        //                     var valor = '<div class="alert alert-success fade in form_tbl_web_convocatorias_descargas">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/formacion/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
        //                     $("#input-archivo").after(valor);
        //                 }

        //                 $("#input-file").attr("value", val);
        //             }

        //         });
        //         $(".errorforms").remove();
        //     }, complete: function () {
        //         $("#form_tbl_web_convocatorias_descargas").dialog("open");
        //     }
        // });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar()
{
    if ($(".selrow").is(':checked')) {
        // var xsmart = $('input:radio[name=selrow]:checked').val();
        // bootbox.dialog({
        //     message: "<strong>¿ Desea Eliminar este registro ?</strong>",
        //     title: "Confirmar",
        //     buttons: {
        //         danger: {
        //             label: "Cancelar",
        //             className: "btn-danger"
        //         },
        //         success: {
        //             label: "Aceptar",
        //             className: "btn-success",
        //             callback: function () {
        //                 $.ajax({
        //                     url: base_url + "gestionconvocatorias/eliminarPublicoFormacion",
        //                     type: 'POST',
        //                     data: {"id": xsmart},
        //                     success: function (msg) {

        //                         if (msg.say == "yes") {
        //                             $('#tbl_web_convocatorias_descargas').dataTable().fnDraw();
        //                         } else {

        //                         }
        //                     }
        //                 });
        //             }
        //         }

        //     }
        // });
    } else {
        errordialogtablecuriosity();
    }
}