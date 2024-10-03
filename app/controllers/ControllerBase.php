<?php

use Phalcon\Mvc\Controller;
use Phalcon\Session;

class ControllerBase extends Controller {

    protected function initialize() {
        $this->tag->prependTitle(' {{ config.global.xNombreAdmin }} ');
        $auth = $this->session->get('auth');
        //print_r($auth); exit();
        $logueado = false;
        $nombre = "";
        
        if (!$this->session->has('auth')) {
            //echo "no esta logueado";
        } else {
            $logueado = true;
            $nombre = $auth["nombres"];
            $codigo = $auth["codigo"];
            $this->view->codigo = $codigo;
        }

        $this->view->logueado = $logueado;
        $this->view->nombre = $nombre;
        
    }

    public function is_logged() {
        
    }

}
