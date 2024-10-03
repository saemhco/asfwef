$(document).ready(function () {
  //alert('Hola Mundo');

  /*$("#btn_login_ratificacion_docentes").on("click", function () {
        window.location.href = "/login-ratificacion-docentes";
      });*/
  //
  $("#btn_login_ratificacion_docentes").on("click", function () {
    //limpiar alertas
    $(".errorforms").hide();

    //alert('Testing');
    if (
      $("#input_nro_doc_login").val() === "" ||
      $("#input_password_login").val() === ""
    ) {
      if ($("#input_nro_doc_login").val() === "") {
        //alert('campo vacio');
        var val =
          '<div class="text-danger errorforms">El campo número de documento es requerido</div>';
        $("#input_nro_doc_login").after(val);
      }
      if ($("#input_password_login").val() === "") {
        var val =
          '<div class="text-danger errorforms">El campo contraseña es requerido</div>';
        $("#input_password_login").after(val);
      }
    } else {
      //ajax
      frm = $("#form_sesion_ratificacion_docentes");
      $.ajax({
        url: frm.attr("action"),
        type: "POST",
        data: frm.serialize(),
        success: function (response) {
          console.log(response.success);
          console.log(response.msg);
          if (response.success) {
            window.location.href = "panel";
          } else {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text(response.msg);
          }
        },
      });
    }
  });
  //fin boton login

  $("#btn_cerrar_alerta").on("click", function () {
    location.reload();
  });
  $("#modal_campo_vacio").on("hide.bs.modal", function () {
    return false;
  });
});

function agregar() {
  // $(".errorforms").hide();
  // $(".error_focus").hide();
  // $("#form_registro_postulante")[0].reset();
  // $('#modal_registro_postulante').modal('show');
  $("#modal_warning").modal("show");
}
