<?php

use Phalcon\Mvc\Controller;
use Phalcon\Session;

class ControllerAuth extends Controller
{

    protected $perfil = "";
    protected function initialize()
    {
        $this->tag->prependTitle(' {{ config.global.xNombreAdmin }} ');
        $auth = $this->session->get('auth');
        //print_r($auth); exit();
        $logueado = false;
        $nombre = "";

        if (!$this->session->has('auth')) {
        } else {
            $logueado = true;
            $nombre = $auth["nombres"];
            $codigo = $auth["codigo"];
            $this->perfil = $auth["perfil"];
            $this->view->codigo = $codigo;
            if (empty($_GET["redirect"])) {
                return $this->response->redirect("panel");
            }
            // return $this->response->redirect("panel");
        }

        $this->view->logueado = $logueado;
        $this->view->nombre = $nombre;
    }

    public function logout()
    {
        $pathUrl = "";
        $this->session->remove('auth');
        switch ($this->perfil) {
            case 54:    /*DOCENTES CONCURSOS RSU*/
                $pathUrl = "login-concursos-rsu.html";
                break;
            case 52:    /*DOCENTES RATIFICACION*/
                $pathUrl = "login-ratificacion-docentes.html";
                break;
            case 48:    /*DOCENTES CONVOCATORIAS*/
                $pathUrl = "login-convocatorias-docentes.html";
                break;
            case 28:    /*PUBLICO CONVOCATORIAS*/
                $pathUrl = "login-convocatorias.html";
                break;
            case 21:    /*ADMISION*/
                $pathUrl = "login-admision.html";
                break;
            case 30:    /*TRAMIT DOCUMENTARIO USUARIOS*/
                $pathUrl = "login-tramite-documentario.html";
                break;
            case 12:    /*ADMINISTRATIVOS*/
                $pathUrl = "login-interno.html";
                break;
            case 3:     /*ALUMNOS*/
                $pathUrl = "login.html";
                break;
            default:
                $pathUrl = "admin";
                break;
        }
        return $this->response->redirect($pathUrl);
    }
}
