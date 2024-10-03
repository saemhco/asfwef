$(document).ready(function () {
  //modal save
  var esExtraordinario = false;
  var extraordinario_desc = "";
  $("#tipo_inscripcion_form").hide();

  if (proceso_id == "4") {
    console.log("Test");
    //$('#wid-id-2').addClass('jarviswidget-collapsed').children('div').slideUp('fast');
  }
  if ($("#modalidad_value").val() == "1") {
    $("#tipo_inscripcion_form").show();
  } else {
  }
  if (tipo_inscripcion_value == "") {
    $("#fileUploadExt").hide();
  } else {
    const txt = $("#tipo_inscripcion option:selected").text();
    $("#txtFileUploadExt").text(txt);
    esExtraordinario = true;
  }

  $("#tipo_inscripcion").change(function () {
    const id = $("#tipo_inscripcion").val();
    const txt = $("#tipo_inscripcion option:selected").text();
    if (id != "") {
      $("#txtFileUploadExt").text(txt);
      $("#fileUploadExt").show();
      extraordinario_desc = txt;
      esExtraordinario = true;
    } else {
      extraordinario_desc = "";
      esExtraordinario = false;
      $("#txtFileUploadExt").text("");
      $("#fileUploadExt").hide();
    }
  });

  $("#modalidad").change(function () {
    let id = $("#modalidad").val();
    if (id == 1) {
      $("#tipo_inscripcion_form").show();
    } else {
      esExtraordinario = false;
      $("#tipo_inscripcion_form").hide();
      $("#tipo_inscripcion").val("");
      $("#txtFileUploadExt").text("");
      $("#fileUploadExt").hide();
    }
  });
  $("#success")
    .dialog({
      autoOpen: false,
      width: 320,
      resizable: false,
      modal: true,
      title:
        "<div class='widget-header text-success' style='color:white;'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
      show: {
        effect: "highlight",
        duration: 300,
      },
      hide: {
        effect: "clip",
        duration: 300,
      },
      buttons: [
        {
          html: "Aceptar",
          class: "btn btn-success btn-sm ",
          click: function () {
            $(this).dialog("close");
            if (id) {
              //window.location.href = base_url + "registropostulantess/inscripcionfin/" + id;
              window.location.href = base_url + "registropostulantess";
            } else {
             // window.location.href =base_url + "registropostulantess/inscripcionfin";
              window.location.href =base_url + "registropostulantess";
            }
          },
        },
      ],
    })
    .prev(".ui-dialog-titlebar")
    .css("background", "#468847");
  //fin succes

  //modal warning
  $("#warning")
    .dialog({
      autoOpen: false,
      width: 320,
      resizable: false,
      modal: true,
      title:
        "<div class='widget-header text-warning' style='color:white;'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
      show: {
        effect: "highlight",
        duration: 300,
      },
      hide: {
        effect: "clip",
        duration: 300,
      },
      buttons: [
        {
          html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
          class: "btn btn-danger",
          click: function () {
            $(this).dialog("close");
            //window.location.href = base_url + "admisionproceso";
          },
        },
        {
          html: "<i class='fa fa-save'></i>&nbsp; Grabar",
          class: "btn btn-info",
          click: function () {
            $(this).dialog("close");
            $(".errorforms").remove();
            var formData = new FormData();
            formData.append("id_postulante", $("#input_postulante").val());
            formData.append("id_admision", $("#input_admision").val());
            formData.append("id_carrera", $("#input_carrera1").val());
            formData.append("id_modalidad", $("#modalidad").val());
            formData.append("id_tipo_modalidad", $("#tipo_inscripcion").val());
            formData.append(
              "fecha_inscripcion",
              $("#input_fecha_inscripcion").val()
            );

            formData.append(
              "archivo_solicitud_02",
              $('input[name="archivo_solicitud_02"]')[0].files[0]
            );
            formData.append(
              "archivo_dni",
              $('input[name="archivo_dni"]')[0].files[0]
            );
            formData.append(
              "archivo_foto_carnet",
              $('input[name="archivo_foto_carnet"]')[0].files[0]
            );
            formData.append(
              "archivo_certificado_estudio_secundaria",
              $('input[name="archivo_certificado_estudio_secundaria"]')[0]
                .files[0]
            );
            formData.append(
              "archivo_solicitud_03",
              $('input[name="archivo_solicitud_03"]')[0].files[0]
            );

            if (esExtraordinario) {
              formData.append(
                "file_upload_ext_value",
                $('input[name="file_upload_ext_value"]')[0].files[0]
              );

              formData.append(
                "desc_tipo_inscripcion",
                $("#tipo_inscripcion option:selected").text()
              );
            }

            formData.append(
              "voucher_file",
              $('input[name="voucher_file"]')[0].files[0]
            );
            formData.append("voucher_nro", $("#voucher_nro").val());
            formData.append("voucher_monto", $("#voucher_monto").val());

            $.ajax({
              url: $("#form_admisionproceso").attr("action"),
              type: "POST",
              //data: frm.serialize(),
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function (msg) {
                var result = msg;
                if (result.say === "yes") {
                  $("#success").dialog("open");
                  //CuriositySoundError();
                } else {
                  //console.log("llegamos a la disco");
                  /*$(".errorforms").remove();

            //Mostrar mensaje error del modelo
            $.each(result, function (i, val) {
              $("#input_" + i).focus();
              $("#input_" + i).after(val);
            });*/
                }
              },
            });
          },
        },
      ],
    })
    .prev(".ui-dialog-titlebar")
    .css("background", "#C09853");
  $("#warning_update")
    .dialog({
      autoOpen: false,
      width: 320,
      resizable: false,
      modal: true,
      title:
        "<div class='widget-header text-warning' style='color:white;'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
      show: {
        effect: "highlight",
        duration: 300,
      },
      hide: {
        effect: "clip",
        duration: 300,
      },
      buttons: [
        {
          html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
          class: "btn btn-danger",
          click: function () {
            $(this).dialog("close");
          },
        },
        {
          html: "<i class='fa fa-save'></i>&nbsp; Grabar",
          class: "btn btn-info",
          click: function () {
            $(this).dialog("close");
            $(".errorforms").remove();
            var formData = new FormData();
            formData.append("id_postulante", $("#input_postulante").val());
            formData.append("id_admision", $("#input_admision").val());
            formData.append(
              "archivo_solicitud_02",
              $('input[name="archivo_solicitud_02"]')[0].files[0]
            );
            formData.append(
              "archivo_dni",
              $('input[name="archivo_dni"]')[0].files[0]
            );
            formData.append(
              "archivo_foto_carnet",
              $('input[name="archivo_foto_carnet"]')[0].files[0]
            );
            formData.append(
              "archivo_certificado_estudio_secundaria",
              $('input[name="archivo_certificado_estudio_secundaria"]')[0]
                .files[0]
            );
            formData.append(
              "archivo_solicitud_03",
              $('input[name="archivo_solicitud_03"]')[0].files[0]
            );

            if (esExtraordinario) {
              formData.append(
                "file_upload_ext_value",
                $('input[name="file_upload_ext_value"]')[0].files[0]
              );
              formData.append(
                "desc_tipo_inscripcion",
                $("#tipo_inscripcion option:selected").text()
              );
            }

              formData.append(
                "voucher_file",
                $('input[name="voucher_file"]')[0].files[0]
              );
              formData.append("voucher_nro", $("#voucher_nro").val());
              formData.append("voucher_monto", $("#voucher_monto").val());
            
            $.ajax({
              url: "registropostulantes/updateInscripcion",
              type: "POST",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function (msg) {
                var result = msg;
                if (result.say == "yes") {
                  $("#success").dialog("open");
                  //CuriositySoundError();
                } else {
                  //console.log("llegamos a la disco");
                  $(".errorforms").remove();
                  //Mostrar mensaje error del modelo
                  $.each(result, function (i, val) {
                    $("#input_" + i).focus();
                    $("#input_" + i).after(val);
                  });
                }
              },
            });
          },
        },
      ],
    })
    .prev(".ui-dialog-titlebar")
    .css("background", "#C09853");

  $("#warning2_update")
    .dialog({
      autoOpen: false,
      width: 320,
      resizable: false,
      modal: true,
      title:
        "<div class='widget-header text-warning' style='color:white;'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
      show: {
        effect: "highlight",
        duration: 300,
      },
      hide: {
        effect: "clip",
        duration: 300,
      },
      buttons: [
        {
          html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
          class: "btn btn-danger",
          click: function () {
            $(this).dialog("close");
          },
        },
        {
          html: "<i class='fa fa-save'></i>&nbsp; Grabar",
          class: "btn btn-info",
          click: function () {},
        },
      ],
    })
    .prev(".ui-dialog-titlebar")
    .css("background", "#C09853");
  //fin
  $("#update").on("click", function (e) {
    e.preventDefault();
    if ($("#proceso_id").val() == "4") {
      if ($("#voucher_file").val() == "") {
        alert("Necesitas subir el voucher");
      } else if ($("#voucher_nro").val() == "") {
        alert("Por favor ingrese el nro del voucher");
      } else if ($("#voucher_monto").val() == "") {
        alert("Por favor ingrese el monto del voucher");
      } else {
        $("#warning_update").dialog("open");
      }
    } else {
      $("#warning_update").dialog("open");
    }
  });
  //grabar
  $("#save").on("click", function (e) {
    e.preventDefault();


    if ($("#modalidad").val() == "") {
      alert("Seleccione una modalidad");
    //} else if (("#modalidad").val() == 1) {
      //alert("Seleccione un tipo de modalidad");
    }else if ($("#input_carrera1").val() == "") {
      alert("Seleccione una carrera");
    }else if ($("#archivo_solicitud_02").val() == "") {
      alert("Necesitas subir anexo 02");
    } else if ($("#archivo_dni").val() == "") {
      alert("Necesitas subir el dni");
    } else if ($("#archivo_foto_carnet").val() == "") {
      alert("Necesitas subir foto de carnet");
    } else if ($("#archivo_certificado_estudio_secundaria").val() == "") {
      alert("Necesitas subir certificado de estudios");
    } else if ($("#archivo_solicitud_03").val() == "") {
      alert("Necesitas subir anexo 03");
    } else if (esExtraordinario && $("#file_upload_ext_value").val() == "") {
      alert("Necesitas subir el archivo : " + extraordinario_desc);
    } else if ($("#voucher_file").val() == "") {
      alert("Necesitas subir el voucher de pago");
    } else if ($("#voucher_nro").val() == "") {
      alert("Por favor ingrese el Nro de Pago");
    } else if ($("#voucher_monto").val() == "") {
      alert("Por favor ingrese el monto de Pago");
    } else {
      $("#warning").dialog("open");
      CuriositySoundError();
    }
  });
  //fin
});



