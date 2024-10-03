var isProcess = false;
$("#showDatosPersonales").hide();

function onScanSuccess(decodedText, decodedResult) {
  $("#titleDatosPersonales").text("");
  if (isProcess == false) {
    isProcess = true;
    $.ajax({
      method: "POST",
      url: `/qr_validacion_process/doc`,
      async: false,
      data: { qr: decodedText },
      success: function (response) {
        if (response.success) {
          $("#showDatosPersonales").show();
          html5QrcodeScanner.clear();

          Swal.fire({
            title: "UNCA",
            text: "Datos encontrados",
            icon: "success",
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              if (response.data.p_estado=="A") {
                $("#titleDatosPersonales").html(
                  "<span class='badge text-bg-success'>FOTOCHECK VIGENTE</span>"
                );
              } else {
                $("#titleDatosPersonales").html(
                  "<span class='badge text-bg-danger'>PERSONAL NO VIGENTE</span>"
                );
              }

              $("#txtDNI").text(response.data.nro_doc);
              $("#txtNombre").text(
                `${response.data.nombres} ${response.data.apellidop} ${response.data.apellidom}`
              );
              $("#txtCargo").text(`${response.data.cargo}`);
              $("#txtOficina").text(`${response.data.oficina}`);
              $("#imgDatosPersonales").attr(
                "src",
                "https://www.unca.edu.pe/" + response.data.foto_perfil
              );
              isProcess = false;
            }
          });
        } else {
          isProcess = false;
          $("#showDatosPersonales").hide();
          html5QrcodeScanner.clear();
          Swal.fire({
            title: "UNCA",
            text: response.message,
            icon: "error",
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              isProcess = false;
            }
          });
        }
      },
      error: function () {
        Swal.fire({
          title: "Error",
          text: "Ha ocurrido un error al cargar los datos.",
          icon: "error",
          allowOutsideClick: false,
        }).then((result) => {
          if (result.isConfirmed) {
            isProcess = false;
          }
        });
      },
    });
  }
}
$("#verifyQr").on("click", () => {
  //location.reload();
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});
function onScanFailure(error) {}

let config = {
  fps: 10,
  supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
  qrbox: { width: 250, height: 250 },
};
let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  config,
  /* verbose= */ false
);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
