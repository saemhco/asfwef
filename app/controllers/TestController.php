<?php
require_once APP_PATH . '/app/library/MailUnca.php';

class TestController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Test');
        $this->view->setTemplateAfter('testing');
        parent::initialize();
    }
    public function testAction(){
        $this->view->disable();
        $codigo_unico = uniqid();
        echo $codigo_unico;
    }
    public function testemailAction($email)
    {

        $this->view->disable();
        try {
            $publico = Publico::findFirst("codigo=1704");
            $email_send = $email;
            $mailer_u = new MailUnca($this->di);
            $mailer_u->setSubject("Registro de Pre-Inscripción al Proceso de Admisión 2024 - I");
            $mailer_u->setTo($email_send);
            $mailer_u->setPathView('registropostulantes/index', ["publico" => $publico]);
            $status_sendmail = $mailer_u->send();
            var_dump($mailer_u->body);
            if ($status_sendmail) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("msg" => "Enviando a {$email_send}", "success" => true));
                $this->response->send();
            } else {
                $this->response->setJsonContent(["msg" => "Error", "message" => $mailer_u->getError(), "success" => false]);
                $this->response->setStatusCode(200);
            }
        } catch (Exception $ex) {
            $this->response->setJsonContent(["msg" => $ex->getLine(), "message" => $ex->getMessage(), "success" => false]);
            $this->response->setStatusCode(200);
        }
    }

    public function indexAction()
    {
        $this->view->disable();

        $client = new Google\Client();
        $client->setAuthConfig(APP_PATH . 'app/config/client_secrets.json');
        $client->addScope("email");
        $client->addScope("profile");

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            // get profile info 
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            var_dump($google_account_info);
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;
            print($name);
            print($email);
            // now you can use this profile info to create account in your website and make user logged in. 
        } else {
            echo "<a target='_blank' href='" . $client->createAuthUrl() . "'>Google Login</a>";
        }
    }

    public function webAction()
    {
        $this->view->disable();
        if (isset($_GET['code'])) {
            $client = new Google\Client();
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            var_dump($token);
        }
    }
}
