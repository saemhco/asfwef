<?php
require_once APP_PATH . '/app/library/phpqrcode/qrlib.php';
require_once APP_PATH . '/app/library/helper/ArcjasCryptUtility.php';


class QrvalidationController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Test');
        $this->view->setTemplateAfter('testing');
        parent::initialize();
    }

    public function qr_validacion_docAction($dni)
    {
        $this->view->disable();
        $codEncrypt = ArcjasCryptUtility::encrypt($dni, ArcjasCryptUtility::KEY_ENCRYPT);
        $size = 10;
        $margin = 2;

        ob_start();
        QRcode::png($codEncrypt, null, QR_ECLEVEL_L, $size, $margin);
        $imageData = ob_get_contents();
        ob_end_clean();

        header("Content-Type: image/png");
        header("Content-Disposition: inline; filename=" . $dni . ".png");
        echo $imageData;
    }
    public function qr_validacion_processAction()
    {
        //if ($this->request->isPost() && $this->request->isAjax()) {
        $this->view->disable();
        $qr = $this->request->get("qr");

        $qrDesencrypt = ArcjasCryptUtility::decrypt($qr, ArcjasCryptUtility::KEY_ENCRYPT);
        $datos = explode(".", $qrDesencrypt);
        $key = $datos[0];

        $response = [];
        if ($key == 'keyunca999') {
            $dni = $datos[1];

            $sql = "
            SELECT pa.estado as p_estado,p.documento,p.imagen as foto_perfil,p.nro_doc,p.nombres,p.apellidop,p.apellidom, pa.cargo as cargo, pa.oficina as oficina
            FROM tbl_web_personal p
            INNER JOIN tbl_web_personal_areas pa ON pa.personal = p.codigo
            WHERE p.nro_doc = :dni AND pa.estado='A' LIMIT 1
        ";

            $result = $this->db->fetchOne($sql, Phalcon\Db::FETCH_OBJ, ['dni' => $dni]);
            $result->foto_perfil = 'adminpanel/imagenes/personal/' . $result->foto_perfil;
            if ($result !== false) {
                $response =  [
                    "success" => true,
                    "data" => $result,
                    "message" => "QR VALIDO",
                ];
            } else {
                $response =  [
                    "success" => false,
                    "message" => "No se encontraron datos del personal",
                ];
            }
        } else {

            $response =  [
                "success" => false,
                "qrDesencrypt" => $qrDesencrypt,
                "qr" => $qr,
                "msg" => "QR INVALIDO",
            ];
        }
        $this->response->setStatusCode(200, "OK");
        $this->response->setJsonContent($response);
        $this->response->send();
        //}
    }
}
