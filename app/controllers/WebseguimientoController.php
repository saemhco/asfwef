<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class WebseguimientoController extends ControllerBase
{

    public function initialize()
    {

        $this->tag->setTitle('Yurimaguas');
        //$this->view->setTemplateAfter('webbolsatrabajo');
        parent::initialize();

        //echo "<pre>";
        //print_r($_SESSION); exit();
    }

    public function indexAction()
    {
        //Mostrar Servicios
        $Servicios = $this->modelsManager->createBuilder()
            ->from('Servicios')
            ->columns('Servicios.id_servicio,
                        Servicios.titular,
                        Servicios.texto_muestra,
                        Servicios.texto_muestra,
                        Servicios.imagen,
                        Servicios.fecha_hora,
                        Servicios.estado')
            ->where("Servicios.estado ='A'")
            ->groupBy("Servicios.id_servicio")
            ->orderBy("Servicios.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->servicios = $Servicios;
    }

    //listado
    public function listadoAction()
    {

        $provincias = "";
        $distritos = "";
        //cerramos sesion si no la inicio
        /*
        if (!$this->session->has('auth')) {
        return $this->response->redirect("");
        }
         */

        $palabra_clave = "";
        $f_cargo = "";
        $f_provincia = "";
        $f_region = "";
        $f_distrito = "";
        $f_jornada = "";
        $f_tipocontrato = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //Cargamos el modelo de los distritos
        $fecha_actual = date("Y-m-d");

        $where = "  empleos.estado = 'A' AND jornadas.numero = 46 AND cargos.numero = 45 AND tipo_contrato.numero = 47 AND empleos.fecha_clausura >= '" . $fecha_actual . "' ";

        if ($this->request->isGet()) {

            if (isset($_GET["palabra_clave"])) {
                $palabra_clave = $this->request->getQuery("palabra_clave", "string");
                $where = $where . " AND titulo ILIKE '%" . $palabra_clave . "%' ";
            }

            if (isset($_GET["cargo"]) && $_GET["cargo"] != "") {
                $f_cargo = $this->request->getQuery("cargo", "int");

                $where = $where . " AND cargos.codigo = " . $f_cargo;

                //echo '<pre>';
                //print_r($where);
                //exit();
            }
            if (isset($_GET["region"]) && $_GET["region"] != "") {
                $f_region = $this->request->getQuery("region", "string");
                //$provincia = Provincias::find(" estado = 'A' AND region = '" . $f_region."'");
                $provincias = Provincias::find(" estado = 'A' AND region = '" . $f_region . "' ");
                $where = $where . " AND region_id = '" . $f_region . "'";
            }

            if (isset($_GET["provincia"]) && $_GET["provincia"] != "") {
                $f_provincia = $this->request->getQuery("provincia", "string");
                $distritos = Distritos::find(" estado = 'A' AND region = '" . $f_region . "' AND provincia = '" . $f_provincia . "' ");

                $where = $where . " AND provincia_id = '" . $f_provincia . "'";
            }

            if (isset($_GET["distrito"]) && $_GET["distrito"] != "") {

                $f_distrito = $this->request->getQuery("distrito", "string");
                //$where = $where . " AND distrito_id = '" . $f_distrito . "'";
                $where = $where . " AND ubigeo_id = '" . $f_distrito . "'";
            }
            if (isset($_GET["jornada"]) && $_GET["jornada"] != "") {
                $f_jornada = $this->request->getQuery("jornada", "int");

                $where = $where . " AND jornada = " . $f_jornada;
            }
            if (isset($_GET["tipocontrato"]) && $_GET["tipocontrato"] != "") {
                $f_tipocontrato = $this->request->getQuery("tipocontrato", "int");
                $where = $where . " AND tipocontrato = " . $f_tipocontrato;
            }
        }

        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        //print $where ; exit();
        //$data = Empleos::find($where);
        //$fecha_actual = date("Y-m-d");
        //Relacionamos el empleo con el empleador para mostrar la empresa
        //        $empleos = $this->modelsManager->createBuilder()
        //                ->from('Empleos')
        //                ->columns('Empleos.codigo,Empleos.numero_visitas,Empleos.descripcion,Empleos.titulo,'
        //                        . 'Empleos.salario,Empleos.fecha_clausura,Empleos.fecha_creacion,Empresas.razon_social,'
        //                        . 'Provincias.descripcion as provincia, Distritos.descripcion as distrito, '
        //                        . 'Jornadas.descripcion as jornada, Empresas.logo ')
        //                ->join('Empresas', 'Empleos.empresa = Empresas.codigo')
        //                ->join('Regiones', 'Empleos.region_id = Regiones.region')
        //                ->join('Provincias', 'Empleos.provincia_id = Provincias.provincia AND Empleos.region_id = Provincias.region ')
        //                ->join('Distritos', 'Empleos.distrito_id = Distritos.distrito AND Empleos.provincia_id = Distritos.provincia AND Empleos.region_id = Distritos.region  ')
        //                ->join('Jornadas', 'Empleos.jornada = Jornadas.codigo')
        //                ->where($where)
        //                //->where("Empleos.estado = 'A' AND Empleos.fecha_clausura >= '2020-03-25' AND region_id = '22' AND provincia_id = '05'")
        //                ->limit(6)
        //                ->orderBy('Empleos.codigo DESC')
        //                ->getQuery()
        //                ->execute();

        $sql_empleos = $this->modelsManager->createQuery("SELECT
        empleos.id_empleo,
        empleos.numero_visitas,
        empleos.descripcion,
        empleos.titulo,
        empleos.salario,
        empleos.fecha_clausura,
        empleos.fecha_creacion,
        empresas.razon_social,
        empresas.imagen,
        jornadas.nombres AS jornada,
        cargos.nombres AS cargo,
        tipo_contrato.nombres AS tipocontrato,
        distritos.descripcion AS distrito
        FROM
        Empleos AS empleos
        INNER JOIN Empresas AS empresas ON empresas.id_empresa = empleos.empresa
        INNER JOIN Jornadas AS jornadas ON jornadas.codigo = empleos.jornada
        INNER JOIN Cargos AS cargos ON empleos.cargo = cargos.codigo
        INNER JOIN TipoContratos AS tipo_contrato ON tipo_contrato.codigo = empleos.tipocontrato
        INNER JOIN Distritos AS distritos ON empleos.distrito_id = distritos.distrito AND empleos.provincia_id = distritos.provincia AND empleos.region_id = distritos.region
        WHERE
        $where
        ORDER BY
        empleos.id_empleo DESC");
        $empleos = $sql_empleos->execute();

        $data = $empleos;

        /*
        foreach ($data as $test) {

        echo "<pre>";
        print_r($test->titulo . '-' . $test->tipocontrato);
        }
        exit();
         */

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $currentPage,
            ]
        );

        $page = $paginator->getPaginate();

        $this->view->page = $page;
        $this->view->f_cargo = $f_cargo;
        $this->view->f_provincia = $f_provincia;
        $this->view->f_region = $f_region;
        $this->view->f_distrito = $f_distrito;
        $this->view->f_jornada = $f_jornada;
        $this->view->f_tipocontrato = $f_tipocontrato;
        $this->view->full_url = $full_url;
        $this->view->palabra_clave = $palabra_clave;

        //Cargamos el modelo de cargos
        $cargos = Cargos::find(" estado = 'A' AND numero = 45 ");
        $this->view->cargos = $cargos;

        //Cargamos el modelo de tipo de contratos
        $tipocontratos = TipoContratos::find(" estado = 'A' AND numero = 47 ");
        $this->view->tipocontratos = $tipocontratos;

        //Cargamos el modelo de las jornadas
        $jornadas = Jornadas::find(" estado = 'A' AND numero = 46 ");
        $this->view->jornadas = $jornadas;

        //Cargamos el modelo de las provincias
        $regiones = Regiones::find(" estado = 'A'  ");
        $this->view->regiones = $regiones;
        $this->view->provincias = $provincias;
        $this->view->distritos = $distritos;

        $db = $this->db;
        //$perid = (int)$perfil;
        $sql_menu_distritos = " SELECT COUNT(*) AS numero_empleos, tbl_btr_empleos.ubigeo_id, distritos.descripcion AS distrito
                                FROM tbl_btr_empleos INNER JOIN distritos ON tbl_btr_empleos.region_id = distritos.region
                                AND tbl_btr_empleos.provincia_id = distritos.provincia
                                AND tbl_btr_empleos.distrito_id = distritos.distrito
                                GROUP BY tbl_btr_empleos.ubigeo_id,distritos.descripcion";
        //print $sql_menu_distritos;
        //exit();
        $menu_distritos = $db->fetchAll($sql_menu_distritos, Phalcon\Db::FETCH_OBJ);
        $this->view->menu_distritos = $menu_distritos;
        //print_r($menu_distritos);exit();
    }

    //detalle
    public function detalleAction($id)
    {

        //echo '<pre>';
        //print_r($_SERVER['DOCUMENT_ROOT']);
        //exit();

        /*
        if (!$this->session->has('auth')) {
        return $this->response->redirect("");
        }
         */
        $auth = $this->session->get('auth');
        if ($auth != '') {
            $key = 'A';
            $this->view->key = $key;
        } else {
            $key = 'I';
            $this->view->key = $key;
        }

        //Cargamos el modelo de empleos
        $empleo = Empleos::findFirstByid_empleo((int) $id);
        $this->view->empleo = $empleo;

        $numero_vis = (int) $empleo->numero_visitas + 1;

        $empleo_cuenta = Empleos::findFirstByid_empleo((int) $id);
        $empleo_cuenta->numero_visitas = $numero_vis;
        $empleo_cuenta->save();

        $fecha_creacion = date('d-m-Y', strtotime($empleo->fecha_creacion));
        $this->view->fecha_creacion = $fecha_creacion;

        $fecha_clausura = date('d-m-Y', strtotime($empleo->fecha_clausura));
        $this->view->fecha_clausura = $fecha_clausura;

        $region = Regiones::findFirst('region = "' . $empleo->region_id . '"');
        $this->view->region = $region;

        $provincia = Provincias::findFirst('region = "' . $empleo->region_id . '" AND provincia = "' . $empleo->provincia_id . '"');
        $this->view->provincia = $provincia;

        $distrito = Distritos::findFirst('region = "' . $empleo->region_id . '" AND provincia = "' . $empleo->provincia_id . '" AND distrito  = "' . $empleo->distrito_id . '"');
        $this->view->distrito = $distrito;

        $empleador = Empresas::findFirstByid_empresa($empleo->empresa);
        $this->view->empleador = $empleador;

        //echo '<pre>';
        //print_r($empleador->razon_social);
        //exit();

        $jornada = Jornadas::findFirstBycodigo($empleo->jornada);
        $this->view->jornada = $jornada;

        //cargos
        $cargos = Cargos::find(" estado = 'A' AND numero = 45");
        $this->view->cargos = $cargos;

        $db = $this->db;
        //$perid = (int)$perfil;
        $sql_menu_distritos = " SELECT COUNT(*) AS numero_empleos, tbl_btr_empleos.ubigeo_id, distritos.descripcion AS distrito
                                FROM tbl_btr_empleos INNER JOIN distritos ON tbl_btr_empleos.region_id = distritos.region
                                AND tbl_btr_empleos.provincia_id = distritos.provincia
                                AND tbl_btr_empleos.distrito_id = distritos.distrito
                                GROUP BY tbl_btr_empleos.ubigeo_id,distritos.descripcion";
        //print $sql_menu_distritos;
        //exit();
        $menu_distritos = $db->fetchAll($sql_menu_distritos, Phalcon\Db::FETCH_OBJ);
        $this->view->menu_distritos = $menu_distritos;

        //Cargamos el modelo de las jornadas
        $jornadas = Jornadas::find(" estado = 'A' AND numero = 46");
        $this->view->jornadas = $jornadas;

        //Cargamos el modelo de tipo de contratos
        $tipocontratos = TipoContratos::find(" estado = 'A' AND numero = 47");
        $this->view->tipocontratos = $tipocontratos;

        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //echo '<pre>';
        //print_r($full_url);
        //exit();

        $this->view->full_url = $full_url;

        $this->assets->addJs("adminpanel/js/viewswebbolsatrabajo/detalle.js?v=" . uniqid());
    }

    //menu idioma
    public function urlCargosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $url = Cargos::find("estado = 'A' AND numero = 45");
            $this->response->setJsonContent($url->toArray());
            $this->response->send();
        }
    }

    //menu distritos
    public function urlDistritosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $url = Empleos::find("estado = 'A'");
            $this->response->setJsonContent($url->toArray());
            $this->response->send();
        }
    }

    //menu jornadas
    public function urlJornadasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $url = Jornadas::find("estado = 'A' AND numero = 46 ");
            $this->response->setJsonContent($url->toArray());
            $this->response->send();
        }
    }

    //menu contratos
    public function urlContratosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $url = TipoContratos::find("estado = 'A' AND numero = 47 ");
            $this->response->setJsonContent($url->toArray());
            $this->response->send();
        }
    }

    //validarcv
    public function validarcvAction()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();
        $this->view->disable();
        $auth = $this->session->get('auth');
        if ($auth != '') {

            if ($this->request->isPost() && $this->request->isAjax()) {

                //echo '<pre>';
                //print_r("Llega");
                //exit();

                $auth = $this->session->get('auth');
                //print_r($_POST);exit();
                //Capturamos la variable de sesion
                //echo "<pre>";
                //print_r($auth['email']);
                //exit();

                $profesional = Alumnos::findFirstBycodigo((int) $auth['codigo']);

                //Capturamos el name del campo input hidden -> idempleo que esta dentro del form
                $idempleo = (int) $this->request->getPost("idempleo", "int");
                $where = " alumno = '" . $auth['codigo'] . "' AND empleo ='" . $idempleo . "'";

                $postulacion = Postulacion::findFirst($where);

                //echo '<pre>';
                //print_r($postulacion->codigo);
                //exit();

                if ($postulacion) {

                    $response = array("postulo" => "si");

                    //echo '<pre>';
                    //print_r("llega si");
                    //exit();
                } else {

                    //echo '<pre>';
                    //print_r("llega no");
                    //exit();

                    $response = array("postulo" => "no");
                }

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("profesional" => $profesional->toArray(), "postulo" => $response));
                //$this->response->send();
            }
        } else {
            $this->response->setJsonContent(array("say" => "no_inicio_sesion"));
        }
        $this->response->send();
    }

    //login
    public function loginAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //tipo de usuario
            $tipousuario = $this->request->getPost('tipousuario', 'string');
            //email
            $email = $this->request->getPost('email');
            //password
            $password = $this->request->getPost('password');
            //nro documento cuando es publico
            //echo '<pre>';
            //print_r("Tipo de ususario:".$tipousuario.'-'."Email:".$email.'-'."Password:".$password);
            //exit();

            if ($tipousuario == 1) {
                //login alumnos
                $where = " estado = 'A' AND email1 = '" . $email . "'";
                $user = Alumnos::findFirst($where);
                //
                if ($user) {
                    $pass = $user->password;
                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'email' => $user->email1,
                            'perfil' => 3,
                        ]);

                        $auth = $this->session->get('auth');
                        $codigo_usuario = $auth["codigo"];
                        $nombre_usuario = $auth["nombres"];

                        //echo '<pre>';
                        //print_r($auth);
                        //exit();

                        $this->response->setJsonContent(array("say" => "yes", "nombre_usuario" => $nombre_usuario, "codigo_usuario" => $codigo_usuario));
                        $this->response->send();
                    } else {

                        $this->response->setJsonContent(array("say" => "password_alumno_incorrecto"));
                        $this->response->send();
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "alumno_no_existe"));
                    $this->response->send();
                }
                //
            } else {

                $this->response->setJsonContent(array("say" => "datos_no_existen"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
            //nuevo
            $this->response->send();
        }
    }

    //savecv
    public function savecvAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //print_r($_FILES);
        //exit();

        $this->view->disable();
        $auth = $this->session->get('auth');

        //echo '<pre>';
        //print_r($auth);
        //exit();

        if ($this->request->isPost() && $this->request->isAjax()) {

            //id_empleo
            $id = (int) $this->request->getPost("idempleo", "int");

            //echo '<pre>';
            //print_r($id);
            //exit();

            if (isset($_POST["cv_defecto"])) {

                //echo '<pre>';
                //print_r("LLega cuando selecciona check");
                //exit();

                $Postulacion = new Postulacion();
                $Postulacion->alumno = $auth['codigo'];

                $Postulacion->empleo = $id;

                //$url_destino = 'adminpanel/archivos/cv/'.'CV'.'-'. $auth['codigo'] . "-" . $file->getName();
                $url_actual = 'adminpanel/archivos/cv/' . 'CV-' . $auth['codigo'] . ".pdf";
                $url_destino = 'adminpanel/archivos/empleos/files_' . $Postulacion->empleo . '/' . 'CV-' . $auth['codigo'] . ".pdf";

                /*
                if (!$file->moveTo($url_destino)) {
                return 0;
                }

                 */
                copy($url_actual, $url_destino);

                //$Postulacion->cv_referencia = $auth['codigo'] . "-" . $file->getName();
                $Postulacion->cv_referencia = 'CV-' . $auth['codigo'] . ".pdf";

                $Postulacion->fecha_postulacion = date('Y-m-d');
                $Postulacion->estado = 1;

//
                if ($Postulacion->save() == false) {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no"));
                } else {

                    // Enviando email a La empresa
                    $empleo = Empleos::findFirstByid_empleo($Postulacion->empleo);
                    $empresa = Empresas::findFirstByid_empresa($empleo->empresa);
                    $email_empresa = $empresa->email;
                    $text_body = " Usted tiene un postulante a la oferta laboral '" . $empleo->titulo . "' , puede revisar esta solicitud ingresando "
                    . " al panel de administracion de Bolsa de Trabajo " . $this->config->global->xAbrevIns;

                    //$this->config->global->xAbrevIns;

                    $mailer = new mailer($this->di);
                    $mailer->setSubject(" Solicutud de Empleo (" . $this->config->global->xAbrevIns . " BOLSA DE TRABAJO) ");
                    $mailer->setTo($email_empresa, $email_empresa);
                    $mailer->setBody($text_body);
                    if ($mailer->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    // Enviando Email al Usuario

                    $email_usuario = $auth['email'];

                    $text_body = " Usted acaba de postular a la oferta laboral '" . $empleo->titulo . "' , puede revisar el estado  "
                    . " de su postulación ingresando al panel de administracion de Bolsa de Trabajo " . $this->config->global->xAbrevIns;

                    $mailer_u = new mailer($this->di);
                    $mailer_u->setSubject(" Solicutud de Empleo (" . $this->config->global->xAbrevIns . " BOLSA DE TRABAJO) ");
                    $mailer_u->setTo($email_usuario, $email_usuario);
                    $mailer_u->setBody($text_body);
                    if ($mailer_u->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
//
            } elseif ($_FILES["cv_nuevo"]["name"] !== "") {
                //echo '<pre>';
                //print_r("LLega cuando sube archivo");
                //exit();

                $Postulacion = new Postulacion();
                $Postulacion->alumno = $auth['codigo'];
                $Postulacion->empleo = $id;

                if ($this->request->hasFiles() == true) {
                    // Print the real file names and sizes
                    foreach ($this->request->getUploadedFiles() as $file) {
                        //$url_destino = 'adminpanel/archivos/cv/'.'CV'.'-'. $auth['codigo'] . "-" . $file->getName();
                        $url_destino = 'adminpanel/archivos/empleos/files_' . $Postulacion->empleo . '/' . 'CV-' . $Postulacion->alumno . ".pdf";

                        if (!$file->moveTo($url_destino)) {
                            return 0;
                        }

                        //echo '<pre>';
                        //print_r("Alumno:" . $Postulacion->alumno . "-" . "Empleo:" . $Postulacion->empleo);
                        //exit();
                    }

                    //$Postulacion->cv_referencia = $auth['codigo'] . "-" . $file->getName();
                    $Postulacion->cv_referencia = 'CV-' . $Postulacion->alumno . ".pdf";
                }
                $Postulacion->fecha_postulacion = date('Y-m-d');
                $Postulacion->estado = 1;

                //echo '<pre>';
                //print_r("LLega cuando sube archivo");
                //exit();

                if ($Postulacion->save() == false) {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no"));
                } else {

                    // Enviando email a La empresa
                    $empleo = Empleos::findFirstByid_empleo($Postulacion->empleo);
                    $empresa = Empresas::findFirstByid_empresa($empleo->empresa);
                    $email_empresa = $empresa->email;
                    $text_body = " Usted tiene un postulante a la oferta laboral '" . $empleo->titulo . "' , puede revisar esta solicitud ingresando "
                    . " al panel de administracion de Bolsa de Trabajo " . $this->config->global->xAbrevIns;

                    //$this->config->global->xAbrevIns;

                    $mailer = new mailer($this->di);
                    $mailer->setSubject(" Solicutud de Empleo (" . $this->config->global->xAbrevIns . " BOLSA DE TRABAJO) ");
                    $mailer->setTo($email_empresa, $email_empresa);
                    $mailer->setBody($text_body);
                    if ($mailer->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    // Enviando Email al Usuario

                    $email_usuario = $auth['email'];

                    $text_body = " Usted acaba de postular a la oferta laboral '" . $empleo->titulo . "' , puede revisar el estado  "
                    . " de su postulación ingresando al panel de administracion de Bolsa de Trabajo " . $this->config->global->xAbrevIns;

                    $mailer_u = new mailer($this->di);
                    $mailer_u->setSubject(" Solicutud de Empleo (" . $this->config->global->xAbrevIns . "BOLSA DE TRABAJO) ");
                    $mailer_u->setTo($email_usuario, $email_usuario);
                    $mailer_u->setBody($text_body);
                    if ($mailer_u->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //get cv
    public function getcvAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo_usuario = (string) $this->request->getPost("codigo_usuario", "string");

            //print("Nombre del alumno:" . $codigo_usuario);
            //exit();

            $Alumnos = Alumnos::findFirstBycodigo("{$codigo_usuario}");

            //print("Nombre del alumno:" . $Alumnos->nombres);
            //exit();

            if ($Alumnos->cv == '') {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_cv"));
            } else {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes_cv"));
            }
        } else {
            $this->response->setStatusCode(500);
        }
        $this->response->send();
    }
    
    public function infointeresAction()
    {

    }

    public function novedadesAction()
    {

    }

    public function testimoniosAction()
    {

    }

    public function contactenosAction()
    {

    }
    
    public function tipspracticasAction()
    {
        //cambios desde mi local
    }
}
