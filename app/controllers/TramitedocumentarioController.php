<?php

class TramitedocumentarioController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/tramitedocumentario.js?v=" . uniqid());
    }

    public function indexAction() {


    }

    public function documentosexternosAction() {

    }

    public function registrodocumentosexternosAction() {

    }

    public function documentosinternosAction() {

    }

    public function registrodocumentosinternosAction() {

    }


}
