$(document).ready(function () {
  $("#form_busqueda_tramite").submit(function () {
    var codigo = $("#input-codigo").val();
    //console.log("Valor:"+x);
    if (codigo === "") {
      //alert("Valor introducido no válido");	
      $(".errorforms").hide();
      var val = '<div class="text-danger errorforms">Debes ingresar el codigo del tramite</div>';
      $("#input-codigo").after(val);
      return false;

    } else {
      return true;
    }
  });

  $("#btn-detalle").on("click", function () {
    var id_doc = $("#input-id_doc").val();
    //console.log("id_doc: "+id_doc);
    $.ajax({
      type: 'POST',
      url: base_url + "web/getAjaxDocumentosDetalles",
      data: { id_doc: id_doc },
      dataType: 'json',
      success: function (response) {
        //console.log(response.say);
        if (response.say === "yes") {

          $("#documentos_detalle").attr("style", "display: block;");

          var html = '';
          $.each(response.documentos_detalles, function (i, val) {
            html = html + '<tr>';
            html = html + '<td>' + val.id_doc_detalle + '</td>';
            html = html + '<td>' + val.fecha + '</td>';
            html = html + '<td>' + val.proveido_nombre + '</td>';
            html = html + '<td>' + val.destinatario + '</td>';
            html = html + '</tr>';
          });

          $('#tbody_documentos_detalles').empty();
          $('#tbody_documentos_detalles').append(html);

        } else if (response.say === 'no') {
          $("#documentos_detalle_vacio").attr("style", "display: block;");
          $("#mensaje_detalle_vacio").text("Trámite sin detalles ....");
        }
      }
    });
  });
});