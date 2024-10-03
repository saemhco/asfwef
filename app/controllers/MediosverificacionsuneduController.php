<?php

class MediosverificacionsuneduController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/mediossunedu.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("medios.id_medio_verificacion");
            $datatable->setSelect("medios.id_medio_verificacion, medios.nombre, "
                    . "medios.descripcion, medios.archivo, "
                    . "medios.enlace, medios.proceso, medios.estado, "
                    . "indicadores.id_indicador, indicadores.nombre as nombre_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion medios  INNER JOIN tbl_lic_indicadores indicadores ON medios.indicador = indicadores.id_indicador");
            $datatable->setWhere("medios.estado = 'A'");
            $datatable->setOrderby("medios.id_medio_verificacion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getArchivosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo_medio_sunedu = $this->request->getPost("archivo_medio");
            $nombre_fichero = 'adminpanel/archivos/medios/' . $archivo_medio_sunedu;

            if (file_exists($nombre_fichero)) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si", "archivo_medio_sunedu" => $archivo_medio_sunedu));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

}
