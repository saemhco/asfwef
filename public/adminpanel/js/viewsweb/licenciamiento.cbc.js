    $(document).ready(function () {

        $("#indicador").on("change", function () {

            //capturamos al id_indicador del select
            var id_indicador = $("#indicador option:selected").val();
            //console.log("id_indicador:" + id_indicador);

            //capturamos al id de la condicion
            var id_condicion = $("#id_condicion").val();
            //console.log("id_condicion:" + id_condicion);

            var indicador_select = $("#indicador option:selected").val();
            console.log("valor indicador:" + indicador_select);
            if (indicador_select === "0") {

                $("#table_medios").css("display", "none");

            } else {

                $("#table_medios").css("display", "block");
                carga_medio(id_indicador, id_condicion);

            }
        });



        function carga_medio(id_indicador, id_condicion) {



            $.post(base_url + "web/verificarMedios", {id_indicador: id_indicador, id_condicion: id_condicion}, function (response) {
                var html = "";
                html = html + '<thead>';
                html = html + '<tr>';
                html = html + '<th><h5>MV</h5></th>';
                html = html + '<th><center><h5>MEDIOS DE VERIFICACIÓN</h5></center></th>';
                html = html + '<th><center><h5>ESTADO</h5></center></th>';
                html = html + '</tr>';
                html = html + '</thead>';
                html = html + '<tbody>';
                $.each(response, function (i, val) {
                    //console.log("Medio-numero:" + val.nro);
                    //console.log("Medio-nombre:" + val.nombre);
                    //console.log("Medio-estado:" + val.estado);
                    html = html + '<tr>';
                    html = html + '<td><h5>' + val.nro + '</h5></td>';
                    html = html + '<td><h5>' + val.nombre + '</h5></td>';

                    if (val.proceso === 1) {
                        html = html + '<td><center><h3><span class="badge badge-success">Completado</span></h3></center></td>';
                    } else if (val.proceso === 0) {

                        html = html + '<td><center><h3><span class="badge badge-warning">&nbsp;En proceso&nbsp;</span></h3></center></td>';

                    }

                    html = html + '</tr>';
                });

                html = html + '</tbody>';

                $("#medios").html(html);


            }, "json");

        }


    });