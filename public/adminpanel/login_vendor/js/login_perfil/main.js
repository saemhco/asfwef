$(function () {
  "use strict";
  $('[data-bs-toggle="tooltip"]').tooltip();

  $('[data-bs-toggle="popover"]').popover("toggle");

  $("#backToMenu").click(() => {
    location.href = "/login-inventory";
  });
  function account_login_perfil_recoveryF() {
    var account_login_perfil_recovery = JSON.parse(
      localStorage.getItem("account_login_perfil_recovery")
    );
    if (account_login_perfil_recovery != null) {
      console.log(account_login_perfil_recovery);
      var $field = $(".form-control").closest(".form-group");
      $field.addClass("field--not-empty");
      $("#input_tipousuario_select").val(
        account_login_perfil_recovery.input_tipousuario_select
      );
      $("#username").val(account_login_perfil_recovery.username);
      $("#password").val(account_login_perfil_recovery.password);
      $("#saveAccount").prop("checked", true);
    }
  }
  account_login_perfil_recoveryF();
  $(".form-control").on("input", function () {
    var $field = $(this).closest(".form-group");
    if (this.value) {
      $field.addClass("field--not-empty");
    } else {
      $field.removeClass("field--not-empty");
    }
  });

  $("#saveAccount").click(function () {
    let value = $("#saveAccount").is(":checked") ? true : false;
    let input_tipousuario_select = $("#input_tipousuario_select").val();
    let username = $("#username").val();
    let password = $("#password").val();
    if (value) {
      localStorage.setItem(
        "account_login_perfil_recovery",
        JSON.stringify({
          input_tipousuario_select: input_tipousuario_select,
          username: username,
          password: password,
        })
      );
    } else {
      localStorage.removeItem("account_login_perfil_recovery");
    }
  });
  $("#input_tipousuario_select").focus(function () {
    $($(".form-group")[0]).addClass("active-input");
  });
  $("#input_tipousuario_select").blur(function () {
    $($(".form-group")[0]).removeClass("active-input");
  });

  $("#username").focus(function () {
    $($(".form-group")[0]).addClass("active-input");
  });
  $("#username").blur(function () {
    $($(".form-group")[0]).removeClass("active-input");
  });

  $("#password").focus(function () {
    $($(".form-group")[1]).addClass("active-input");
  });
  $("#password").blur(function () {
    $($(".form-group")[1]).removeClass("active-input");
  });
  $(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
  var isLogin = false;
  $("#btnLogin").click(function (e) {
    e.preventDefault();
    let username = $("#username").val();
    let password = $("#password").val();
    let input_tipousuario_select = $("#input_tipousuario_select").val();

    if (input_tipousuario_select == "") {
      Swal.fire({
        title: "UNCA - Advertencia",
        text: "Por favor seleccione el tipo de estudiante",
        icon: "warning",
        confirmButtonText: "Aceptar",
        allowOutsideClick: false,
        allowEscapeKey: false,
      });
    } else if (username == "") {
      Swal.fire({
        title: "UNCA - Advertencia",
        text: "Por favor ingrese el usuario",
        icon: "warning",
        confirmButtonText: "Aceptar",
        allowOutsideClick: false,
        allowEscapeKey: false,
      });
    } else if (password == "") {
      Swal.fire({
        title: "UNCA - Advertencia",
        text: "Por favor ingrese la contraseña",
        icon: "warning",
        confirmButtonText: "Aceptar",
        allowOutsideClick: false,
        allowEscapeKey: false,
      });
    } else {
      if (isLogin == false) {
        isLogin = true;
        $("#divLogin").html(
          '<button id="btnLogin" class="btn btn-block btn-primary" type="button" disabled style="width:100%;height: 40px"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Cargando...</span></button>'
        );
        grecaptcha
          .execute("6LetFsokAAAAANw_8B4sNQTs_kse1Qa8RGkvDJXd", {
            action: "subscribe_newsletter",
          })
          .then(function (token) {
            let value = $("#saveAccount").is(":checked") ? true : false;
            if (value) {
              localStorage.setItem(
                "account_login_perfil_recovery",
                JSON.stringify({
                  input_tipousuario_select: input_tipousuario_select,
                  username: username,
                  password: password,
                })
              );
            } else {
              localStorage.removeItem("account_login_perfil_recovery");
            }

            $("#login-form").prepend(
              '<input type="hidden" name="token" value="' + token + '">'
            );
            $("#login-form").prepend(
              '<input type="hidden" name="action" value="subscribe_newsletter">'
            );
            $.ajax({
              url: urlPath + "web/loginperfiles",
              type: "POST",
              data: $("#login-form").serialize(),
              beforeSend: function () {},
              success: function (msg) {
                isLogin = false;
                $("#divLogin").html(
                  '<button id="btnLogin" class="btn btn-block btn-primary" type="button"  style="width:100%;height: 40px">Ingresar</button>'
                );
                if (msg.say == "yes") {
                  Swal.fire({
                    title: "UNCA",
                    text: "Inicio de sesión exitoso",
                    icon: "success",
                    confirmButtonText: "Aceptar",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      if (tipo_rend == "biblioteca") {
                        window.location.href = urlPath + url_rend;
                      } else {
                        window.location.href = urlPath + "panel";
                      }
                    }
                  });
                  //window.location.href = "{{ url('panel') }}";
                } else {
                  Swal.fire({
                    title: "UNCA",
                    text: "Credenciales no registradas , inténtelo nuevamente",
                    icon: "warning",
                    confirmButtonText: "Aceptar",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    } else {
                      location.reload();
                    }
                  });
                }
              },
            });
          });
      }
    }
  });
});
