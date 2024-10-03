
<?php

use Phalcon\Mvc\Controller;

//use Phalcon\Mvc\Url;

class ControllerPanel extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('Plataforma Virtual | ');
        $this->view->setTemplateAfter('layoutpanel');
        $auth = $this->session->get('auth');
        if (!$this->session->has('auth')) {
            $route_default = $this->session->get('route_default');
            $route_default_url = $route_default["url"];
            header('Location: /' . $route_default_url);
        } else {
            $nombre = $auth["nombres"];
            $perfil = $auth["perfil"];
            $this->addRouteDefault($perfil);
            $perfil_id = $auth["perfil"];
        }
        $this->view->nombre = $nombre;
        $this->view->perfil = $perfil;

        $url_link = str_replace($_SERVER["SCRIPT_NAME"], "", $_SERVER["REQUEST_URI"]);


        $name_project = $this->url->getBaseUri();

        $url_current = str_replace($name_project, "", $url_link);


        #Proceso para audita los permisos por URL  
        $url_controller_audit = $this->router->getRewriteUri();
        $PerfilModulo = Permiso::find("perfil_id = {$perfil_id} AND estado = 'A'  ");
        $perfil = Perfil::findFirst("id={$perfil_id}");
        $this->view->perfil_desc = $perfil->per_descripcion;
        $this->view->perfil_alias = $perfil->alias;

        $urls = [];
        foreach ($PerfilModulo as $key => $value) {
            $mod = Modulo::findFirst(array("estado = 'A' AND id = {$value->modulo_id}  ", "order" => "mod_orden"));
            $urls[] = "/" . $mod->mod_url;
        }

        //urls fantasmas
        $urls[] = "/panel";
        $urls[] = "/gestionplanillas";
        $urls[] = "/gestionreportes";
        $urls[] = "/gestionnotas1530";
        $urls[] = "/copiaseguridad";
        $urls[] = "/btrpublicaciones/postulantes";
        $urls[] = "/gestiontramitedocumentarioexterno/registro5";



        //print $url_controller_audit;
        //echo "<pre>";
        //print_r($urls) ;

        $segment_controller = explode("/", $url_controller_audit);
        $segment_controller = "/" . $segment_controller[1];
        //print $segment_controller; 
        //exit();

        if ($this->request->isPost() && $this->request->isAjax()) {
        } else {
            if (in_array(trim($url_controller_audit), $urls)) {
            } else {

                if (in_array(trim($segment_controller), $urls)) {
                } else {
                    //return $this->response->redirect("panel");
                }
            }
        }
    }
    public function addRouteDefault($perfil)
    {
        $pathUrl = "";
        switch ($perfil) {
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
            case 12:    /*ADMINISTRATIVOS*/
                $pathUrl = "login-interno.html";
                break;
            case 3:     /*ALUMNOS*/
                $pathUrl = "login.html";
                break;
            case 30:     /*TRAMITE DOCUMENTARIO WEB*/
                $pathUrl = "login-tramite-documentario.html";
                break;
            default:
                $pathUrl = "admin";
                break;
        }

        $this->session->set('route_default', [
            'url' => $pathUrl,
        ]);
    }
}
