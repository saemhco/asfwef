$(document).ready(function () {
    //Para activar modal
    //$('#myModal').modal('show');
    $.ajax({
        type: 'POST',
        url: base_url + "web/getModal",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            $.each(response, function (i, val) {

                $("#titulo").text(val.titulo);
                $("#subtitulo").attr("href", val.enlace);
                $("#subtitulo").text(val.subtitulo);
                $("#descripcion").text(val.descripcion);
                $("#boton_enlace").attr("href", val.enlace);

            });
        }, complete: function () {
            $('#myModal').modal('show');
        }
    });

    $("#boton_enlace").on("click", function () {
        $('#myModal').modal('hide');
    });
});