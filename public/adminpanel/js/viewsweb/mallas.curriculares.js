$(document).ready(function () {



    $("#input-carrera").on("change", function () {
    
        var carrera = $("#input-carrera option:selected").val();
        carga_curricula(carrera);
        $("#panel-body-curricula").css("display", "block");
        $("#table-asignaturas").css("display", "none");

        valor_carrera = $(this).val();
        if(valor_carrera == "0"){

            $('#input-curricula').selectpicker("refresh")
        }

       

    });

    $("#input-curricula").on("change", function () {

        carga_asignatura($(this).val());

        $("#table-asignaturas").css("display", "block");

        console.log("llega");
    });



    function carga_curricula(carrera) {

        console.log("Lista asignaturas");
        
       
        
        $.post(base_url + "web/listarCurriculas", { carrera: carrera }, function (response) {

            var html = "";

            

            //$('#input-curricula').append('<option value="0">---SELECCIONE---</option>');

            html = html + '<option value="0">---SELECCIONE---</option>';

            $.each(response, function (i, val) {

                html = html + '<option value="' + val.codigo + '"> ' + val.descripcion + '</option>';

            });


        

            $("#input-curricula").html(html).selectpicker('refresh');
            


        }, "json");

    }

    function carga_asignatura(curricula) {
        console.log("llega curricula: " + curricula);

       
        tbl_asignaturas = $("#tbl_asignaturas").DataTable({
            "destroy": true,
            "responsive": true,
            "stateSave": true,
            "ajax": { "url": base_url + "web/datatableAsignaturas/" + curricula, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                //{ "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                //{"data": "imagen_1", "name": "ob.imagen_1"},
                { "data": "codigo", "name": "a.codigo" },
                { "data": "nombre", "name": "a.nombre" },
                { "data": "curricula", "name": "cu.descripcion" },
                { "data": "ciclo", "name": "a.ciclo" },
                { "data": "creditos", "name": "a.creditos" },
                { "data": "ht", "name": "a.ht" },
                { "data": "hp", "name": "a.hp" },
                { "data": "tipo_asignatura", "name": "t_a.nombres" },
                { "data": "estado", "name": "a.estado" }

            ],
            "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            "autoWidth": true,
            "createdRow": function (row, data, index) {


                var estado = "";
                if (data.estado === 'A') {
                    estado = '<span class="badge badge-success">ACTIVO</span>';
                } else if (data.estado === 'X') {
                    estado = '<span class="badge badge-warning">INACTIVO</span>';
                }
                $('td', row).eq(8).html(estado);


            },
            //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "dom": 'Blfrtip',
            "buttons": [
                {
                    "extend": 'excelHtml5',
                    "text": '<i class="fa fa-file-excel-o"> Excel</i>',
                    "titleAttr": 'Exportar a Excel',
                    "className": 'btn btn-raised btn-success m-1',
                    "filename": "Universidad Nacional Ciro Alegria - Malla Curricular"
                },
                {
                    "extend": 'pdfHtml5',
                    "text": '<i class="fa fa-file-pdf-o"> Pdf</i>',
                    "titleAttr": 'Exportar a PDF',
                    "className": 'btn btn-raised btn-danger m-1',
                    "filename": "Universidad Nacional Ciro Alegria - Malla Curricular"
                },
                {
                    "extend": 'print',
                    "text": '<i class="fa fa-print"> Imprimir</i>',
                    "titleAttr": 'Imprimir',
                    "className": 'btn btn-raised btn-primary m-1',
                    "filename": "Universidad Nacional Ciro Alegria - Malla Curricular"
                }
            ],
            initComplete: function () {
                //Busqueda al dar enter
                //$('.dataTables_filter input').attr('style', 'float: left !important');
                $('.dataTables_filter input').attr("placeholder", "Buscar Asignatura...");
                $('.dataTables_filter input').attr('style', 'width: 1000px !important');
                $('div.dataTables_filter input').unbind();
                $('div.dataTables_filter input').bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        $('#tbl_asignaturas').dataTable().fnFilter(this.value);
                    }
                });
            },




        });

    }


});