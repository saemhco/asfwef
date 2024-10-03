$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_notas_alumnos = $("#tbl_notas_alumnos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionalumnos/datatable_notas_alumnos/" + id, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "searching": true,
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
//            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "descripcion", "name": "sem.descripcion"},
            {"data": "asignatura", "name": "al_a.asignatura"},
            {"data": "nombre", "name": "a.nombre"},
            {"data": "ciclo", "name": "a.ciclo"},
            {"data": "nombres", "name": "tipo.nombres"},
            {"data": "veces", "name": "al_a.veces"},
            {"data": "pf", "name": "al_a.pf"},
            {"data": "observacion", "name": "al_a.observacion"},
            {"data": "estado", "name": "al_a.estado"}


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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_notas_alumnos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            //if( data.tipo_inquilino_id == "1") {  

            //console.log("semestre:" + data.semestre);
            //console.log("asignatura:" + data.asignatura);
            //console.log("alumno:" + data.alumno);
            //console.log("veces:" + data.veces);
            //console.log("tipo:" + data.tipo);

//            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.semestre + '" pk2="' + data.asignatura + '" pk3="' + data.alumno + '" pk4="' + data.veces + '" pk5="' + data.tipo + ' " ><i></i> </label></center>';
//            $('td', row).eq(0).html(html);



        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_notas_alumnos').dataTable().fnFilter(this.value);
                }
            });
        }

    });

    //Error asignatura
    $("#error_asignatura_registrada").dialog({
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
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });



    //error de tipo
    $("#error_tipo").dialog({
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
                    //window.location.href = base_url + "alumnos/registro/" + id;
                }
            }]
    });

    //fomrulario registro
    $("#form_notas_alumnos").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Notas Asignaturas</h4></div>",
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
                    frmx = $("#form_notas_alumnos");
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
                            if (result.say === "yes") {

                                $('#tbl_notas_alumnos').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");


                                $("#form_notas_alumnos").dialog("close");



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

//validacion select asignaturas
    $("#input-asignatura").on("change", function () {
        //alert('Testing');
        var asignatura = $("#input-asignatura option:selected").val();
        var alumno = id;
        //alert("enaviamos:"+asignatura+"-"+alumno);

        $.ajax({
            type: 'POST',
            url: base_url + "gestionalumnos/asignaturaRegistrada",
            data: {asignatura: asignatura, alumno: alumno},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    $("#error_asignatura_registrada").dialog("open");
                    CuriositySoundError();


                } else {

                }

                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });

    });
//

});

//agregar
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //pks
    //$("#input-semestre").val("");
    //$("#input-asignatura").val("");
    //$("#input-alumno").val("");
    //$("#input-veces").val("");
    //$("#input-tipo").val("");
    //fin pks
    $("#form_notas_alumnos")[0].reset();
    $("#form_notas_alumnos").dialog("open");
    $("#input-estado").prop("checked", true);
}

//editar
function editar() {

    $('#input-asignatura').attr("style", "pointer-events: none;");
    $("#input-estado").prop("checked", false);

    if ($(".selrow").is(':checked')) {
        var semestre = $('input:radio[name=selrow]:checked').val();
        //alert(semestre);

        //asignatura
        var asignatura = $('input:radio[name=selrow]:checked').attr('pk2');
        //alert(asignatura);

        //alumno
        var alumno = $('input:radio[name=selrow]:checked').attr('pk3');

        //alumno
        var veces = $('input:radio[name=selrow]:checked').attr('pk4');

        //tipo         
        var tipo = $('input:radio[name=selrow]:checked').attr('pk5');
        //alert(tipo);

        if (parseInt(tipo) === 9) {
            $.ajax({
                type: 'POST',
                url: base_url + "gestionalumnos/getAjaxNotasAlumnos",
                data: {semestre: semestre, asignatura: asignatura, alumno: alumno, veces: veces, tipo: tipo},
                dataType: 'json',
                success: function (response) {
                    //var result = JSON.parse(msg);
                    $.each(response, function (i, val) {
                        //i(nombre del campo) y val(calor de la bd)
                        $("#input-" + i).val(val);
                        //console.log(i);

                        console.log("valor de i :" + i);
                        console.log("valor de val :" + val);

                        if (i === "estado") {

                            if (val === "1") {
                                //Usamos la propiedad prop para el check
                                console.log("Entro aqui");
                                $("#input-" + i).prop("checked", true);

                            }
                        }





                    });

                    $(".errorforms").remove();
                }, complete: function () {
                    //alert(response.say);
                    $("#form_notas_alumnos").dialog("open");
                }
            });
        } else {
            $("#error_tipo").dialog("open");
            CuriositySoundError();
        }



    } else {
        errordialogtablecuriosity();
    }
}

//eliminar
function eliminar() {
    if ($(".selrow").is(':checked')) {
        //semestre
        var semestre = $('input:radio[name=selrow]:checked').val();

        //alert(semestre);

        //asignatura
        var asignatura = $('input:radio[name=selrow]:checked').attr('pk2');

        //alumno
        var alumno = $('input:radio[name=selrow]:checked').attr('pk3');

        //alumno
        var veces = $('input:radio[name=selrow]:checked').attr('pk4');

        //tipo         
        var tipo = $('input:radio[name=selrow]:checked').attr('pk5');

        bootbox.dialog({
            message: "<strong>¿ Desea Eliminar este registro ?</strong>",
            title: "Confirmar",
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "gestionalumnos/eliminar",
                            type: 'POST',
                            data: {"semestre": semestre, "asignatura": asignatura, "alumno": alumno, "veces": veces, "tipo": tipo},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_notas_alumnos').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}
