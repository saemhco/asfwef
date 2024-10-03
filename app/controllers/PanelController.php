<?php

class PanelController extends ControllerPanel
{
    public function initialize()
    {
        $this->tag->setTitle('Admin');
        parent::initialize();
    }

    public function indexAction()
    {
          $perfil = $this->session->get('auth')["perfil"];
          $this->view->perfil = $perfil;
          
          $nombre_perfil = $this->session->get('auth')["nombre_perfil"];
          $this->view->nombre_perfil = $nombre_perfil;
          
    }
}