$(document).ready(function () {

    $("#indicador1").on("change", function () {

        console.log("Hola Mundo");

        //capturamos al id_indicador del select
        var id_indicador1 = $("#indicador1 option:selected").val();
        //console.log("id_indicador:" + id_indicador);

        //capturamos al id de la condicion
        var id_condicion1 = $("#id_condicion1").val();
        //console.log("id_condicion:" + id_condicion);

        var indicador_select = $("#indicador1 option:selected").val();
        console.log("valor indicador:" + indicador_select);
        if (indicador_select === "0") {

            $("#table_medios1").css("display", "none");

        } else {

            $("#table_medios1").css("display", "block");
            carga_medio1(id_indicador1, id_condicion1);

        }
    });



    function carga_medio1(id_indicador1, id_condicion1) {



        $.post(base_url + "web/verificarMedios1", { id_indicador1: id_indicador1, id_condicion1: id_condicion1 }, function (response) {
            var html = "";
            html = html + '<thead>';
            html = html + '<tr>';
            html = html + '<th><h5>MV</h5></th>';
            html = html + '<th><center><h5>MEDIOS DE VERIFICACIÓN</h5></center></th>';

            html = html + '<th><center><h5>ARCHIVO</h5></center></th>';
            html = html + '<th><center><h5>ESTADO</h5></center></th>';
            html = html + '</tr>';
            html = html + '</thead>';
            html = html + '<tbody>';
            $.each(response, function (i, val) {
                //console.log("Medio-numero:" + val.nro);
                //console.log("Medio-nombre:" + val.nombre);
                //console.log("Medio-estado:" + val.estado);
                html = html + '<tr>';
                html = html + '<td><h5>' + val.codigo_mv + '</h5></td>';
                html = html + '<td><h5>' + val.nombre + '</h5></td>';

                
                html = html + '<td style="color: #000000;text-align:center !important; padding-top:25px !important;" width="15%">';

                if (val.archivo_resolucion) {

                    html = html + '<a class="btn btn-raised btn-royal btn-xs"  href=" ' + base_url + 'adminpanel/archivos/resoluciones/' + val.archivo_resolucion + '" target="_blank" width="10%">R</a>';

                }

                if (val.archivo_documento) {
                    html = html + '<a class="btn btn-raised btn-royal btn-xs" href=" ' + base_url + 'adminpanel/archivos/documentos/' + val.archivo_documento + '" target="_blank" width="10%">D</a>';
                }

                if (val.archivo_enlace) {
                    html = html + '<a class="btn btn-raised btn-royal btn-xs" href=" ' +val.archivo_enlace + '" target="_blank" width="10%">E</a>';
                }

                html = html + '</td>';

                if (val.proceso === 1) {
                    html = html + '<td><center><h3><span class="badge badge-success">Completado</span></h3></center></td>';
                } else if (val.proceso === 0) {

                    html = html + '<td><center><h3><span class="badge badge-warning">&nbsp;En proceso&nbsp;</span></h3></center></td>';

                }


                html = html + '</tr>';
            });

            html = html + '</tbody>';

            $("#medios1").html(html);


        }, "json");

    }


});