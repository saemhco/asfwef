$(document).ready(function(){

	var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_planillas = $("#tbl_tipo_planillas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroplanillas/datatableTipoPlanilla", "type": "POST"},
        "processing": false,
        "serverSide": true,
     	
        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "nombre", "name": "nombre"},
            {"data": "id_planilla_tipo", "name": "id_planilla_tipo"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_tipo_planillas'), breakpointDefinition);
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
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
           
            $('td', row).eq(2).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_tipo_planillas').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    $("#btn-ingresos").on("click",function(){

        console.log("ingresos");
        var tipo = "ingresos"
        var etiqueta = $("#ingresos").val();
        var factor = $("#factor-ingreso").val();

        if (etiqueta == "" || factor == "") {
            bootbox.alert("<strong>Los campos solicitados son requeridos</strong>");
            return 0;
        }

        var html = createRow(etiqueta,factor,tipo);
        $("#llena-ingresos").append(html);
        enumerateRow(tipo);
    })

    $("#btn-descuentos").on("click",function(){
         
        var tipo = "descuentos"
        var etiqueta = $("#descuentos").val();
        var factor = $("#factor-descuento").val();

        if (etiqueta == "" || factor == "") {
            bootbox.alert("<strong>Los campos solicitados son requeridos</strong>");
            return 0;
        }

        var html = createRow(etiqueta,factor,tipo);
        $("#llena-descuentos").append(html);
        enumerateRow(tipo);
    })

    $("#btn-aportes").on("click",function(){
         
        var tipo = "aportes"
        var etiqueta = $("#aportes").val();
        var factor = $("#factor-aporte").val();

        if (etiqueta == "" || factor == "") {
            bootbox.alert("<strong>Los campos solicitados son requeridos</strong>");
            return 0;
        }

        var html = createRow(etiqueta,factor,tipo);
        $("#llena-aportes").append(html);
        enumerateRow(tipo);
    })

    $("#btn-guarda").on("click",function(){
        frm = $("#form-config");
        $.ajax({
            url: base_url+"registroplanillas/saveconfig",
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert("<strong>Se registró correctamente ...</strong>");
                     window.location.href = base_url + "registroplanillas/configuracion/";
                } else {
                    bootbox.alert("<strong>ocurrio un error...</strong>");
                }
            }
        });       
    })


    $("#form_tipo_planillas").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Tipo de Planillas</h4></div>",
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
                    frm = $("#form_tipo_planillas");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_tipo_planillas').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_tipo_planillas").dialog("close");
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
    $("#form_tipo_planillas .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;

        }
    }); // fin validar enter


})

function config() {
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        //alert(xsmart);

        window.location.href = base_url + "registroplanillas/config/"+xsmart ;

    } else {
        errordialogtablecuriosity();
    }

}

function createRow(etiqueta,factor,tipo){
    var html = "<tr>";
        html = html+"<td class='orden'></td>";
        html = html+"<td><input type='text' class='form-control input-xs' name='"+tipo+"-etq[]' value='"+etiqueta+"' ></td>";
        html = html+"<td><input type='text' class='form-control input-xs' name='"+tipo+"-factor[]' value='"+factor+"' ></td>";
    html = html+"</tr>";
    return html;
}


function enumerateRow(tipo){
    var itemCounter = 0;
    $('#llena-'+tipo+' tr').each(function() {
        itemCounter += 1;
        $('td.orden', this).text(itemCounter);
    });
}

function agregar() {
    $("#form_tipo_planillas")[0].reset();
     $("#input-codigo").val("");
    $("#input-estado").prop("checked", true);
    
    $("#form_tipo_planillas").dialog("open");
       
}

function editar() {
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registroplanillas/getTipoPlanillas",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);

                    if (i === "estado") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i).prop("checked", true);

                        }
                    }
                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_tipo_planillas").dialog("open");
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
                            url: base_url + "registroplanillas/eliminarTipoPlanillas",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_tipo_planillas').dataTable().fnDraw();
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