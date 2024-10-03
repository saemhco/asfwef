$(document).ready(function () {


//alert("Hola Mundo");


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_actividadesaeie = $("#tbl_actividadesaeie").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "actividadesaeie/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "id_actividad_aei", "name": "id_actividad_aei"},
            {"data": "ano_eje", "name": "ano_eje"},
            {"data": "nombre", "name": "nombre"},
            {"data": "descripcion", "name": "descripcion"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_actividadesaeie'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            console.log("ano_eje:" + data.ano_eje);
            //var html = '<input type="hidden" id="ano_eje_pk" name="ano_eje_pk" value="' + data.ano_eje_pk + '">';
            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_actividad_aei + '" pk2="' + data.ano_eje + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_actividadesaeie').dataTable().fnFilter(this.value);
                }
            });
        }
    });
    //exito datos guardados
    $("#exito_actividadesaeie").dialog({
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
                    window.location.href = base_url + "actividadesaeie";
                }
            }]
    });

    //error objetivo
    $("#error_objetivosei").dialog({
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
                    window.location.href = base_url + "actividadesaeie/registro";
                }
            }]
    });

    //
    //Error encuesta ya registrada para esa asignatura
    $("#error_indicadoresei").dialog({
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
                    window.location.href = base_url + "actividadesaeie/registro";
                }
            }]
    });


    //error
    $("#error_accionesei").dialog({
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
                    window.location.href = base_url + "actividadesaeie/registro";
                }
            }]
    });

    //
    $("#error_indicadoresaei").dialog({
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
                    window.location.href = base_url + "actividadesaeie/registro";
                }
            }]
    });

    //error
    $("#error_ano_eje").dialog({
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
                    window.location.href = base_url + "actividadesaeie/registro";
                }
            }]
    });


//Publicar form
    $("#publicar").on("click", function () {
        var objetivoei = $("#input-id_objetivo_ei option:selected").val();
        var indicadorei = $("#input-id_indicador_ei option:selected").val();
        var id_accion_ei = $("#input-id_accion_ei option:selected").val();

        var id_indicador_aei = $("#input-id_indicador_aei option:selected").val();

        if (objetivoei === '') {
            $("#error_objetivosei").dialog("open");
            CuriositySoundError();
        } else {

            if (indicadorei === '') {
                $("#error_indicadoresei").dialog("open");
                CuriositySoundError();
            } else {
                if (id_accion_ei === '') {
                    $("#error_accionesei").dialog("open");
                    CuriositySoundError();
                } else {
                    //
                    if (id_indicador_aei === '') {

                        $("#error_indicadoresaei").dialog("open");
                        CuriositySoundError();

                        //alert("tipo vacio");

                    } else {
                        frmx = $("#form_actividadesaeie");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_docentes");
                        var frm = new FormData(document.getElementById("form_actividadesaeie"));
                        //datos += "&contenido=" + encodeURIComponent(editor.getData());
                        //frm.append('texto_muestra', editor.getData());
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
                                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                                    //window.location.href = base_url + "actividadesaeie";
                                    $("#exito_actividadesaeie").dialog("open");
                                    CuriositySoundError();
                                } else {
                                    console.log("llegamos a la disco");
                                    $(".errorforms").remove();
                                    //Mostrar mensaje error del modelo
                                    $.each(result, function (i, val) {
                                        $("#input-" + i).focus();
                                        $("#input-" + i).after(val);
                                    });
                                }
                            }
                        });
                    }
                    //
                }
            }

        }







    });
    //valida enter
    $("#form_actividadesaeie .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter




    //-----------actividadesaeiee-------------------------------
    //gf
    $('#input-gf_01').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_01").blur(function () {
        var gfp = new Number($("#input-gf_01").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_01").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_01").val(entero.toFixed(2));
        }

    });

    $('#input-gf_02').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_02").blur(function () {
        var gfp = new Number($("#input-gf_02").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_02").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_02").val(entero.toFixed(2));
        }

    });

    $('#input-gf_03').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_03").blur(function () {
        var gfp = new Number($("#input-gf_03").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_03").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_03").val(entero.toFixed(2));
        }

    });

    $('#input-gf_04').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_04").blur(function () {
        var gfp = new Number($("#input-gf_04").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_04").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_04").val(entero.toFixed(2));
        }

    });

    $('#input-gf_05').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_05").blur(function () {
        var gfp = new Number($("#input-gf_05").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_05").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_05").val(entero.toFixed(2));
        }

    });

    $('#input-gf_06').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_06").blur(function () {
        var gfp = new Number($("#input-gf_06").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_06").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_06").val(entero.toFixed(2));
        }

    });

    $('#input-gf_07').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_07").blur(function () {
        var gfp = new Number($("#input-gf_07").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_07").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_07").val(entero.toFixed(2));
        }

    });

    $('#input-gf_08').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_08").blur(function () {
        var gfp = new Number($("#input-gf_08").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_08").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_08").val(entero.toFixed(2));
        }

    });

    $('#input-gf_09').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_09").blur(function () {
        var gfp = new Number($("#input-gf_09").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_09").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_09").val(entero.toFixed(2));
        }

    });

    $('#input-gf_10').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_10").blur(function () {
        var gfp = new Number($("#input-gf_10").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_10").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_10").val(entero.toFixed(2));
        }

    });


    $('#input-gf_11').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_11").blur(function () {
        var gfp = new Number($("#input-gf_11").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_11").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_11").val(entero.toFixed(2));
        }

    });

    $('#input-gf_12').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-gf_12").blur(function () {
        var gfp = new Number($("#input-gf_12").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-gf_12").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-gf_12").val(entero.toFixed(2));
        }

    });

    $('#input-gf_porcentaje').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#input-gf_monto_programado').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    //go
    $('#input-go_01').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_01").blur(function () {
        var gfp = new Number($("#input-go_01").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_01").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_01").val(entero.toFixed(2));
        }

    });

    $('#input-go_02').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_02").blur(function () {
        var gfp = new Number($("#input-go_02").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_02").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_02").val(entero.toFixed(2));
        }

    });

    $('#input-go_03').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_03").blur(function () {
        var gfp = new Number($("#input-go_03").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_03").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_03").val(entero.toFixed(2));
        }

    });

    $('#input-go_04').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_04").blur(function () {
        var gfp = new Number($("#input-go_04").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_04").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_04").val(entero.toFixed(2));
        }

    });

    $('#input-go_05').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_05").blur(function () {
        var gfp = new Number($("#input-go_05").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_05").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_05").val(entero.toFixed(2));
        }

    });

    $('#input-go_06').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_06").blur(function () {
        var gfp = new Number($("#input-go_06").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_06").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_06").val(entero.toFixed(2));
        }

    });

    $('#input-go_07').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_07").blur(function () {
        var gfp = new Number($("#input-go_07").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_07").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_07").val(entero.toFixed(2));
        }

    });

    $('#input-go_08').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_08").blur(function () {
        var gfp = new Number($("#input-go_08").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_08").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_08").val(entero.toFixed(2));
        }

    });

    $('#input-go_09').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_09").blur(function () {
        var gfp = new Number($("#input-go_09").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_09").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_09").val(entero.toFixed(2));
        }

    });

    $('#input-go_10').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_10").blur(function () {
        var gfp = new Number($("#input-go_10").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_10").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_10").val(entero.toFixed(2));
        }

    });

    $('#input-go_11').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_11").blur(function () {
        var gfp = new Number($("#input-go_11").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_11").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_11").val(entero.toFixed(2));
        }

    });

    $('#input-go_12').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#input-go_12").blur(function () {
        var gfp = new Number($("#input-go_12").val());

        //console.log("Es entero:" + Number.isInt(gfp));

        if (gfp % 1 === 0) {
            //alert("Es un numero entero");
            $("#input-go_12").val(gfp + ".00");
        } else {
            //alert("Es un numero decimal");
            var entero = new Number(gfp);
            //alert(entero.toFixed(2));
            $("#input-go_12").val(entero.toFixed(2));
        }

    });

    $('#input-go_total').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#input-go_porcentaje').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    //




    $("#input-id_indicador_aei").on("change", function () {

        var ano_eje = $("#input-ano_eje option:selected").val();
        //alert(ano_eje);


        var id_indicador_ei = $(this).val();

        if (id_indicador_ei === '') {

            alert("Selecione el objetivo");

        } else {

            //
            $.ajax({
                type: 'POST',
                url: base_url + "actividadesaeie/getActividadesaei",
                data: {id: id_indicador_ei, ano_eje: ano_eje},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'si') {
                        //alert(response.pk_aumenta);

                        var id_accion_ei = response.pk_aumenta;



                        if (id_accion_ei === 2 || id_accion_ei === 3 || id_accion_ei === 4 || id_accion_ei === 5 || id_accion_ei === 6 || id_accion_ei === 7 || id_accion_ei === 8 || id_accion_ei === 9) {

                            //id_accion_ei_n = parseInt(id_accion_ei) + 1;
                            //alert(id_accion_ei);
                            console.log("id_indicador_aei:" + id_indicador_ei);

                            var nuevo_id_indicador_ei = id_indicador_ei.replace("IAEI", "AEIAP");
                            //console.log("id_accion_ei:" + nuevo_id_indicador_ei);


                            var codigo_nuevo = nuevo_id_indicador_ei + ".0" + id_accion_ei;
                            $("#input-codigo").val(codigo_nuevo);

                        } else {


                            var nuevo_id_indicador_ei = id_indicador_ei.replace("IAEI", "AEIAP");
                            console.log("id_accion_ei:" + nuevo_id_indicador_ei);

                            var codigo_nuevo = nuevo_id_indicador_ei + "." + id_accion_ei;
                            $("#input-codigo").val(codigo_nuevo);
                        }



                    } else {

                        var nuevo_id_indicador_ei = id_indicador_ei.replace("IAEI", "AEIAP");
                        console.log("id_accion_ei:" + nuevo_id_indicador_ei);

                        var codigo_nuevo = nuevo_id_indicador_ei + ".01";
                        $("#input-codigo").val(codigo_nuevo);

                    }

                    $(".errorforms").remove();
                }, complete: function () {
                    //$("#form_curriculas").dialog("open");
                    //alert('Estado:' + estado);

                }
            });
            //






        }



    });

    //
    $("#input-ano_eje").on("change", function () {

        var id_indicador_ei = $("#input-id_indicador_ei option:selected").val();
        //alert(id_indicador_ei);


        var ano_eje = $(this).val();

        if (ano_eje === '') {

            // alert("Selecione el objetivo");
            $("#error_ano_eje").dialog("open");
            CuriositySoundError();

        } else {

            //
            $.ajax({
                type: 'POST',
                url: base_url + "actividadesaeie/getActividadesaei",
                data: {id: id_indicador_ei, ano_eje: ano_eje},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'si') {
                        //alert(response.pk_aumenta);

                        var id_accion_ei = response.pk_aumenta;



                        if (id_accion_ei === 2 || id_accion_ei === 3 || id_accion_ei === 4 || id_accion_ei === 5 || id_accion_ei === 6 || id_accion_ei === 7 || id_accion_ei === 8 || id_accion_ei === 9) {

                            //id_accion_ei_n = parseInt(id_accion_ei) + 1;
                            //alert(id_accion_ei);
                            //console.log("id_indicador_ei:"+id_indicador_ei);

                            var nuevo_id_indicador_ei = id_indicador_ei.replace("IAEI", "AEIAP");
                            console.log("id_accion_ei:" + nuevo_id_indicador_ei);


                            var codigo_nuevo = nuevo_id_indicador_ei + ".0" + id_accion_ei;
                            $("#input-codigo").val(codigo_nuevo);

                        } else {


                            //alert("Testing");

                            //id_accion_ei_n = parseInt(id_accion_ei) + 1;

                            var nuevo_id_indicador_ei = id_indicador_ei.replace("IAEI", "AEIAP");
                            console.log("id_accion_ei:" + nuevo_id_indicador_ei);

                            var codigo_nuevo = nuevo_id_indicador_ei + "." + id_accion_ei;
                            $("#input-codigo").val(codigo_nuevo);
                        }



                    } else {

                        var nuevo_id_indicador_ei = id_indicador_ei.replace("IAEI", "AEIAP");
                        console.log("id_accion_ei:" + nuevo_id_indicador_ei);

                        var codigo_nuevo = nuevo_id_indicador_ei + ".01";
                        $("#input-codigo").val(codigo_nuevo);

                    }

                    $(".errorforms").remove();
                }, complete: function () {
                    //$("#form_curriculas").dialog("open");
                    //alert('Estado:' + estado);

                }
            });
            //






        }



    });
    //


    //objetivos ei select
    $("#input-id_objetivo_ei").on("change", function () {
        var ano_eje = $("#input-id_objetivo_ei option:selected").attr("ano_eje");
        //carga_indicadoresei($(this).val(), 0);
        carga_indicadoresei($(this).val(), ano_eje);

        //alert("Testing");
    });


    //carga indicadoresei
    function carga_indicadoresei(id_objetivo_ei, ano_eje) {
        $.post(base_url + "actividadesaeie/getIndicadoresei", {id_objetivo_ei: id_objetivo_ei, ano_eje: ano_eje}, function (response) {
            var html = "";
            html = html + '<option value="">Seleccione...</option>';
            $.each(response, function (i, val) {

                var res_descripcion = val.descripcion.substr(0, 60);
                html = html + '<option value="' + val.id_indicador_ei + '" ano_eje = "' + val.ano_eje + '"> ' + val.id_indicador_ei + ' - ' + res_descripcion + '...' + '</option>';

            });

            $("#input-id_indicador_ei").html(html);
        }, "json");
    }

    //indicadore select
    $("#input-id_indicador_ei").on("change", function () {
        var ano_eje = $("#input-id_indicador_ei option:selected").attr("ano_eje");
        carga_accionesei($("#input-id_indicador_ei").val(), ano_eje);
    });

    //carga accionesei
    function carga_accionesei(id_indicador_ei, ano_eje) {

        $.post(base_url + "actividadesaeie/getAccionesei", {id_indicador_ei: id_indicador_ei, ano_eje: ano_eje}, function (response) {
            var html = "";
            html = html + '<option value="">Seleccione...</option>';
            $.each(response, function (i, val) {

                html = html + '<option value="' + val.id_accion_ei + '" ano_eje="' + ano_eje + '">' + val.descripcion + '</option>';

            });

            $("#input-id_accion_ei").html(html);
        }, "json");

    }

    //select accionesei
    $("#input-id_accion_ei").on("change", function () {
        var ano_eje = $("#input-id_accion_ei option:selected").attr("ano_eje");
        carga_indicadoresaei($("#input-id_accion_ei").val(), ano_eje);
    });

    //carga indicadoresaei
    function carga_indicadoresaei(id_accion_ei, ano_eje) {

        $.post(base_url + "actividadesaeie/getIndicadoresaei", {id_accion_ei: id_accion_ei, ano_eje: ano_eje}, function (response) {
            var html = "";
            html = html + '<option value="">Seleccione...</option>';
            $.each(response, function (i, val) {

                html = html + '<option value="' + val.id_indicador_aei + '">' + val.descripcion + '</option>';

            });

            $("#input-id_indicador_aei").html(html);
        }, "json");

    }



});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_accion_ei").val("");
    $("#form_actividadesaeie")[0].reset();
    $("#form_actividadesaeie").dialog("open");
}

//Funcion editar
function editar() {

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var ano_eje = $('input:radio[name=selrow]:checked').attr('pk2');

        //alert(xsmart);

        window.location.href = base_url + "actividadesaeie/registro/" + xsmart + "/" + ano_eje;
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var ano_eje = $('input:radio[name=selrow]:checked').attr('pk2');

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
                            url: base_url + "actividadesaeie/eliminar",
                            type: 'POST',
                            //data: {"id": xsmart},
                            data: {"id": xsmart, "id2": ano_eje},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_actividadesaeie').dataTable().fnDraw();
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