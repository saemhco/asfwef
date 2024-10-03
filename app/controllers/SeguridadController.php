<?php
require_once APP_PATH . '/app/library/GoogleAuth2/vendor/autoload.php';

use Phalcon\Mvc\Controller;


class SeguridadController extends ControllerAuth
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
    }




    public function loginConvocatoriasAction()
    {
        
        //recaptchav3
        //$site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        //$this->view->site_key = $site_key;
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;
        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //        $postulante = Publico::count();
        //        $nuevo_postulante = $postulante + 1;
        //$this->view->codigo_nuevo_publico = $nuevo_postulante;
        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85 ORDER BY orden");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

    }
    public function loginPerfilAction()
    {
        $client = new Google\Client();
        $client->setAuthConfig(APP_PATH . 'app/config/client_secrets.json');
        $client->addScope("email");
        $client->addScope("profile");
        $this->view->url_google = $client->createAuthUrl();
    }
    public function loginInternoAction()
    {
      
    }
    public function loginAdmisionAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;
        $postulante = Publico::count();
        $nuevo_postulante = $postulante + 1;
        $this->view->codigo_nuevo_postulante = $nuevo_postulante;
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguro = $seguros;
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;
        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;
    }
    public function googleVerifyAction()
    {
        $client = new Google\Client();
        $client->setAuthConfig(APP_PATH . 'app/config/client_secrets.json');
        $client->addScope("email");
        $client->addScope("profile");
        if (isset($_GET['code'])) {
            $email = strtolower($this->request->getPost('email')) . $this->config->global->xEmailIns;
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $sessionGoogle = [];
            $tipoSession = null;
            $alumno = Alumnos::findFirst("estado = 'A' AND email1 = '" . $email . "'");
            $docente = Docentes::findFirst("estado = 'A' AND email1 = '" . $email . "'");
            if ($alumno) {
                $sessionGoogle = [
                    'codigo' => $alumno->codigo,
                    'nombres' => $alumno->nombres,
                    'email' => $alumno->email1,
                    'perfil' => 3,
                    'tipo' => 1,
                ];
                $tipoSession = 1;
            } else if ($docente) {
                $sessionGoogle = [
                    'codigo' => $docente->codigo,
                    'nombres' => $docente->nombres,
                    'full_name' => $docente->apellidop . " " . $docente->apellidom . " " . $docente->nombres,
                    'perfil' => 4,
                    'tipo' => 2,
                ];
                $tipoSession = 2;
            } else {
                $tipoSession = null;
            }
            if ($tipoSession == null) {
                return $this->response->redirect("login-perfil");
            } else {
                $this->session->set('auth', $sessionGoogle);
                return $this->response->redirect("panel");
            }
        } else {
            echo 'No existe codigo';
        }
    }
    public function loginRatificacionDocentesAction()
    {
    }
    public function loginConvocatoriasDocentesAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85 ORDER BY orden");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //sexo
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //tipobonificacion
        $tipobonificaciones = TipoBonificaciones::find("estado = 'A' AND numero = 134 ORDER BY orden ASC");

        // foreach ($tipobonificaciones as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->codigo);
        //     print_r($value->nombres);
        // }
        // exit();

        $this->view->tipobonificaciones = $tipobonificaciones;
    }



    public function login_concursos_rsuAction()
    {
        //$this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }


    public function loginConcursosRsuAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                $user = Docentes::findFirst($where);
              
                if ($user) {

                    $pass = $user->password;
                    /* Desencryptar */
                    $nombre_perfil = 'DOCENTES CONCURSOS RSU';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    if ($this->security->checkHash($password, $pass)) {

                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 2,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {

                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            } else {


                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function recuperarAction()
    {
        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha0.js?v=" . uniqid() . "");
    }
    public function loginAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {
                $username = $this->request->getPost('usuario', 'string');
                $password = $this->request->getPost('password', 'string');
                $token = $this->request->getPost('token', 'string');
                $action = $this->request->getPost('action', 'string');


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6LetFsokAAAAACVECLCM1m6gyOJjUaevM-FeIhed', 'response' => $token)));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $arrResponse = json_decode($response, true);
                // verify the response 
                if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.3) {
                    $where = " estado = 'A' AND usu_usuario = '" . $username . "'";
                    $user = Usuario::findFirst($where);

                    $pass = $user->usu_clave;

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'usuario_id' => $user->id,
                            'nombres' => $user->usu_nombre,
                            'perfil' => $user->perfil_id
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {
                    
                    $this->response->setStatusCode(404);
                    $this->response->setJsonContent($arrResponse);
                    $this->response->send();
                }
            } else {
               # $this->response->setStatusCode(404);
                $this->response->setJsonContent(array("say" => "error 1",'csrf'=>$this->security->checkToken("csrf", $this->request->getPost('csrf'))));
                $this->response->send();
            }
        } else {
           # $this->response->setStatusCode(404);
            $this->response->setJsonContent(array("say" => "error 2"));
            $this->response->send();
        }
    }

    public function logoutAction()
    {
        parent::logout();
        
    }
}
