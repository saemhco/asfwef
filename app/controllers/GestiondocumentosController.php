<?php

class GestiondocumentosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/lectorpdf.js?v=" . uniqid());
    }

    public function mostrarAction($enlace = null) {
        //print("Nombre del enlace: ".$enlace);
        //exit();
        $documentos = Documentosgestion::findFirstByenlace($enlace);
        //print("Nombre del archivo: ".$documentos->archivo);
        //exit();
        $this->view->documentos = $documentos;
    }
}
