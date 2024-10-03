$(document).ready(function () {
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_libro = $("#tbl_libros").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registrolibros/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        
        "columnDefs": [
            { "width": "87px", "targets": 4 }
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

            { "data": "id_libro", "name": "id_libro" },
            { "data": "titulo", "name": "titulo" },
            { "data": "autores", "name": "autores" },
            { "data": "codigo", "name": "codigo" },
            { "data": "isbn", "name": "isbn" },
            { "data": "cantidad_ejemplares", "name": "cantidad_ejemplares" },
            { "data": "ubicacion", "name": "ubicacion" },
            { "data": "id_libro", "name": "id_libro" },
            { "data": "id_libro", "name": "id_libro" },
            { "data": "estado", "name": "estado" }
        ],

        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_libros'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html_estado = "";
            if (data.autores === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(2).html(autores);

            var valorAutor = data.autores.split("/");
            var autor1 = valorAutor[0];
            var autor2 = valorAutor[1];
            var autor3 = valorAutor[2];
            console.log("Autor1:"+autor1);
            console.log("Autor2:"+autor2);
            console.log("Autor3:"+autor3);

            if(autor1){
                var resultado1 = autor1;
            }



            if(autor2 === ""){
                var resultado2 = "";
            }else{
                var resultado2= " / "+autor2;
            }

            if(autor3 === ""){
                var resultado3 = "";
            }else{
                var resultado3 = " / "+autor3;
            }

            var autores = resultado1+resultado2+resultado3;

            $('td', row).eq(3).html(autores);



            //Etiqueta
            var html1 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "reportes/reporteetiqueta/" + data.id_libro + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(8).html(html1);

            //Ficha
            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "reportes/reporteficha/" + data.id_libro + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(9).html(html2);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(10).html(html_estado);


        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_libros').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    $("#form_autores").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Autores</h4></div>",
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
                frm = $("#form_autores");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            //console.log(result.id_autor_nuevo);

                            var id_autor_nuevo = result.id_autor_nuevo;

                            $("#form_autores").dialog("close");

                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                //location.reload();
                                //                                    let $lider_list = $('#input-autor_1 option');
                                //                                    $('#input-autor_1').append($('<option />', {
                                //                                        text: 'I: Líder ' + ($lider_list.length + 1),
                                //                                        value: $lider_list.length + 1
                                //                                    }));

                                var autor_nombre = $("#input-descripcion_autor").val();

                                $("#input-autor_1").append($('<option>', { value: id_autor_nuevo, text: autor_nombre }));
                                $("#input-autor_2").append($('<option>', { value: id_autor_nuevo, text: autor_nombre }));
                                $("#input-autor_3").append($('<option>', { value: id_autor_nuevo, text: autor_nombre }));

                            });

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


    $("#form_editoriales").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Editoriales</h4></div>",
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
                frm = $("#form_editoriales");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            var id_editorial_nuevo = result.id_editorial_nuevo;

                            $("#form_editoriales").dialog("close");

                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                //location.reload();
                                //                                    let $lider_list = $('#input-autor_1 option');
                                //                                    $('#input-autor_1').append($('<option />', {
                                //                                        text: 'I: Líder ' + ($lider_list.length + 1),
                                //                                        value: $lider_list.length + 1
                                //                                    }));

                                var editorial_nombre = $("#input-descripcion_editorial").val();

                                $("#input-editorial").append($('<option>', { value: id_editorial_nuevo, text: editorial_nombre }));


                            });
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
                window.location.href = base_url + "registrolibros";
            }
        }]
    });



    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_libros");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_libros"));
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
                if (result.say === "yes") {
                    $("#success").dialog("open");

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    //Mostrar mensaje error del modelo
                    $.each(result, function (i, val) {
                        //$("#input-" + i).focus();
                        //$("#input-" + i).after(val);

                        //codigo_libro
                        if (i === 'codigo') {
                            $("#input-codigo").after(val);
                        }

                        //titulo
                        if (i === 'titulo') {
                            $("#input-titulo").after(val);
                        }

                        //isbn
                        if (i === 'isbn') {
                            $("#input-isbn").after(val);
                        }

                        //codigo_barra
                        if (i === 'codigo_barra') {
                            $("#input-codigo_barra").after(val);
                        }

                        //tipo_material_bibliografico
                        if (i === 'tipo_material_bibliografico') {
                            $("#input-tipo_material_bibliografico").after(val);
                        }

                        //idioma
                        if (i === 'idioma') {
                            $("#input-idioma").after(val);
                        }

                        //categoria
                        if (i === 'categoria') {
                            $("#input-categoria").after(val);
                        }

                        //cantidad_ejemplares
                        if (i === 'cantidad_ejemplares') {
                            $("#input-cantidad_ejemplares").after(val);
                        }

                        if (i === 'paginas') {
                            $("#input-paginas").after(val);
                        }

                        if (i === 'autor_1') {
                            $("#input-autor_1_select").after(val);
                        }

                        if (i === 'editorial') {
                            $("#input-editorial_select").after(val);
                        }

                        if (i === 'anio_publicacion') {
                            $("#input-anio_publicacion").after(val);
                        }


                    });
                }
            }
        });
    });


    //valida enter
    $("#form_libros .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


    //    if(idl){
    //        llenadatos(idl);
    //    }



    //para activar el select2 (buscador)
    $('#input-autor_1').select2();
    $('#input-autor_2').select2();
    $('#input-autor_3').select2();
    $('#input-editorial').select2();




});

function reporte_pdf() {
    window.open(base_url + "reportes/reportelibros");
}

function reporte_xls() {
    window.open(base_url + "exportar/exportarlibros");
}

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_libro").val("");
    $("#form_libros")[0].reset();
    $("#form_libros").dialog("open");
}


//function llenadatos(idl){
//     
//
//        $.ajax({
//            type: 'POST',
//            url: base_url + "registrolibros/getAjax",
//            data: {id: idl},
//            dataType: 'json',
//            success: function (response) {
//
//                console.log(response);
//                //var result = JSON.parse(msg);
//
//                //response.libro
//
//
//                $.each(response.detalle, function (i, val) {
//
//                    var xd = i + 1;
//                    $("#input-autor_id_" + xd).val(val.autor_id);
//
//
//
//                });
//                
//               
//                $(".errorforms").remove();
//            }, complete: function () {
//                //$("#form_libros").dialog("open");
//            }
//        });
//}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "registrolibros/registro/" + xsmart;



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
                            url: base_url + "registrolibros/eliminar",
                            type: 'POST',
                            data: { "id_libro": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_libros').dataTable().fnDraw();
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

//agregar autor
function agregar_autor() {
    $(".errorforms").hide();
    $("#form_autores")[0].reset();
    $("#input-id_autor").val("");
    $("#form_autores")[0].reset();
    $("#input-estado_autor").prop("checked", true);
    $("#form_autores").dialog("open");

}

//agregar editorial
function agregar_editorial() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_editorial").val("");
    $("#form_editoriales")[0].reset();
    $("#input-estado_editorial").prop("checked", true);
    $("#form_editoriales").dialog("open");
}


function agregarEjemplarGeneral() {
    $.ajax({
        type: 'POST',
        url: base_url + "registrolibros/saveEjemplaresGenral",
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            if (response.say === "yes") {

                bootbox.alert("<strong>Se registró correctamente</strong>");
                $('#tbl_libros').dataTable().fnDraw();

            }
            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_libros_ejemplares").dialog("open");
        }
    });
}