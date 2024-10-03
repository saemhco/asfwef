$(document).ready(function () {

     var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_asignaturasofertadas = $("#tbl_asignaturasofertadas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "configpromedios/datatableregistro/" + codigo + "/" + semestre, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            {"data": "grupo", "name": "grupo"},
            //{"data": "subgrupo", "name": "subgrupo"},
            //{"data": "modalidad_nombre", "name": "modalidad_nombre"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_asignaturasofertadas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html_grupos = "";
            html_grupos = "<button type='button'  class='btn btn-xs btn-primary' data-toggle='modal' data-target='#modal_agregar_horario' onclick='agregar(" + data.semestre + ",\"" + data.asignatura + "\"," + data.grupo + ");'><i class='fa fa-edit'></i></button>";
            $('td', row).eq(2).html(html_grupos);


        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_asignaturasofertadas').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    $("#agregar").on("click",function(){
        var etiqueta = $("#etiqueta").val();
        var html = createRow(etiqueta);
        $("#llena_etiquetas").append(html);
        enumerateRow();
    });

    $("#semestre").on("change",function(){
       var sema = $(this).val();
       window.location.href = base_url + "configpromedios/index/"+sema;
    });

});

function createRow(value){
    var html = "<tr>";
        html = html+"<td class='orden'></td>";
        html = html+"<td><input type='hidden' name='etq[]' value='"+value+"' >"+value+"</td>";
        html = html+"<td>";
            html = html+"<button class='btn btn-success btn-xs' onclick='moveRow(this,1)'><i class='fa fa-arrow-up' ></i></button> ";
            html = html+"<button class='btn btn-success btn-xs' onclick='moveRow(this,0)'><i class='fa fa-arrow-down' ></i></button> ";
            html = html+"<button class='btn btn-danger btn-xs' onclick='deleteRow(this)' ><i class='fa fa-remove' ></i></button>";
        html = html+"</td>";
    html = html+"</tr>";
    return html;
}

function moveRow(t,opt){
    var row = $(t).closest('tr');
    console.log(row);
    if(opt == 1){
        row.prev().before(row);
    }else{
        row.next().after(row);
    }
    enumerateRow();
}

function deleteRow(t){
    $(t).closest('tr').remove(); 
    enumerateRow();
}

function enumerateRow(){
    var itemCounter = 0;
    $('#llena_etiquetas tr').each(function() {
        itemCounter += 1;
        $('td.orden', this).text(itemCounter);
    });
}

function agregar(semestre,asignatura,grupo){
     window.location.href = base_url + "configpromedios/config/"+semestre+"/"+asignatura+"/"+grupo;
}

