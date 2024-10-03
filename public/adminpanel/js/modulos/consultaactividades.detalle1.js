$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_actividades = $("#tbl_actividades").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "consultaactividades/datatabledetalle1/"+id_personal, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha", "name": "fecha"},
            {"data": "id_actividad", "name": "id_actividad"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_actividades'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var fecha_split = data.fecha;
            var fecha_split_1 = fecha_split.split(" ");
            var fecha_split_2 = fecha_split_1[0].split("-");
            var fecha = fecha_split_2[2] + '/' + fecha_split_2[1] + '/' + fecha_split_2[0];
            $('td', row).eq(1).html(fecha);


            var actividad = "<a role='button' class='btn btn-xs btn-primary' href='" + base_url + "consultaactividades/detalle2/" + data.id_actividad + "' >   <i class='fa fa-list' ></i></a>";
            $('td', row).eq(2).html(actividad);


        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_actividades').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    //valida enter
    $("#form_actividades .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter
    
    
    
        $("#form_reporte_actividades_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "300px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte Actividades Excel</h4></div>",
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
                html: "<i class='fa fa-file-excel-o'></i>&nbsp; Exportar", "id": "graba",
                "class": "btn btn-success",
                click: function () {

                    //var fecha_inicio = $("#input-fecha_inicio").val();
                    //var fecha_fin = $("#input-fecha_fin").val();
                    //console.log("Fecha Inicio:" + fecha_inicio + " " + "Fecha Fin:" + fecha_fin);
                    $(".errorforms").remove();

                    if ($("#input-fecha_inicio").val() === "" || $("#input-fecha_fin").val() === "") {
                        //console.log("Entra Aqui");
                        if ($("#input-fecha_inicio").val() === "") {
                            var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
                            $("#input-fecha_inicio").after(val);
                        }

                        if ($("#input-fecha_fin").val() === "") {
                            var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
                            $("#input-fecha_fin").after(val);
                        }
                    } else {
                        var fecha_inicio1 = $("#input-fecha_inicio").val();
                        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
                        console.log("fecha_incio:" + fecha_inicio);

                        var fecha_fin1 = $("#input-fecha_fin").val();
                        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
                        console.log("fecha_fin:" + fecha_fin);

                        window.open(base_url + "exportar/reportegestionactividades/" + fecha_inicio + "/" + fecha_fin);
                    }

                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


});



function reporte_actividades_xls() {
    $(".errorforms").remove();
    $("#form_reporte_actividades_xls")[0].reset();
    $("#form_reporte_actividades_xls").dialog("open");
    //window.open(base_url + "exportar/reportegestionactividades/" + fecha_inicio + "/" + fecha_fin);

}