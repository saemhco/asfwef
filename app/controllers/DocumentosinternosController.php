<?php

class DocumentosinternosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/documentosinternos.js?v=" . uniqid());
    }
    
    //index
    public function indexAction() {
        
    }


    //agregar y editar
    public function registroAction() {

    }

}
