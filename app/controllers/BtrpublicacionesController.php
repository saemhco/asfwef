<?php

class BtrpublicacionesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/btrpublicaciones.js?v=" . uniqid() . "");
    }

    public function indexAction()
    {
        //    echo '<pre>';
        //            print_r($auth = $this->session->get('auth'));
        //            exit();

        $perfil_usuario = $this->session->get("auth")["nombres"];
        $this->view->perfil_usuario = $perfil_usuario;
    }

    public function empleosAction()
    {
        $perfil_usuario = $this->session->get("auth")["nombres"];
        $this->view->perfil_usuario = $perfil_usuario;
        $this->assets->addJs("adminpanel/js/modulos/btrpublicaciones.empleos.js?v=" . uniqid() . "");
    }

    public function postulantesAction($id)
    {
        $perfil_usuario = $this->session->get("auth")["nombres"];
        $this->view->perfil_usuario = $perfil_usuario;
        $this->view->idwork = $id;
        $this->assets->addJs("adminpanel/js/modulos/btrpublicaciones.postulantes.js?v=" . uniqid() . "");
    }

    public function registroAction($id = null)
    {
        $this->view->id = $id;

        //
        if ($id != null) {
            $Empleo = Empleos::findFirstByid_empleo((int) $id);
        } else {
            $Empleo = Empleos::findFirstByid_empleo(0);
        }

        $this->view->empleo = $Empleo;
        //

        $regiones = Regiones::find("estado = 'A' ");
        $cargos = Cargos::find("estado = 'A' AND numero = 45");
        $jornadas = Jornadas::find("estado = 'A' AND numero = 46");
        $tipocontratos = TipoContratos::find("estado = 'A' AND numero = 47");

        $this->view->regiones = $regiones;
        $this->view->cargos = $cargos;
        $this->view->jornadas = $jornadas;
        $this->view->tipocontratos = $tipocontratos;
    }

    public function descargacvAction($id_user)
    {
        $obj = Alumnos::findFirstBycodigo($id_user);
        $file = $obj->cv;
        $response = new \Phalcon\Http\Response();
        $path = 'adminpanel/archivos/cv/' . $file;
        $filetype = filetype($path);
        $filesize = filesize($path);
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ", "-", $file), true);
        $response->send();
        die();
    }

    public function descargaAction($iduser, $empleo, $param = null)
    {

        if ($param !== '' or $param == null) {
            // es porque lleno un cv unico
            $Postulacion = Postulacion::findFirst("alumno = '{$iduser}' AND empleo = $empleo ");
            $empleo = $Postulacion->empleo;
            $alumno = $Postulacion->alumno;

            //echo '<pre>';
            //print_r($empleo.'-'.$alumno);
            //exit();
        }

        $response = new \Phalcon\Http\Response();
        $path = 'adminpanel/archivos/empleos/files_' . $empleo . '/' . 'CV-' . $alumno . ".pdf";

        //echo '<pre>';
        //print_r($path);
        //exit();

        $filetype = filetype($path);
        $filesize = filesize($path);
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, true);
        //$response->setFileToSend($path, str_replace(" ", "-", $file), true);
        $response->send();
        die();
    }

    public function getDistritosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $region_id = $this->request->getPost("pk");
            $prov_id = $this->request->getPost("idprov");
            $Distritos = Distritos::find('region="' . $region_id . '" AND provincia="' . $prov_id . '"');
            $this->response->setJsonContent($Distritos->toArray());
            $this->response->send();
        }
    }

    public function getProvinciasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $region_id = $this->request->getPost("pk");
            $Distritos = Provincias::find('region="' . $region_id . '"');
            $this->response->setJsonContent($Distritos->toArray());
            $this->response->send();
        }
    }

    public function saveAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                
                $id = (int) $this->request->getPost("id_empleo", "int");
                $Empleo = Empleos::findFirstByid_empleo($id);
                $Empleo = (!$Empleo) ? new Empleos() : $Empleo;

                $Empleo->titulo = $this->request->getPost("titulo", "string");
                $Empleo->ciudad = $this->request->getPost("ciudad", "string");
                $Empleo->descripcion = $this->request->getPost("descripcion", "string");
                $Empleo->requisitos = $this->request->getPost("requisitos");
                $Empleo->region_id = $this->request->getPost("region_id", "string");
                $Empleo->provincia_id = $this->request->getPost("provincia_id", "string");
                $Empleo->distrito_id = $this->request->getPost("distrito_id", "string");
                $Empleo->cargo = $this->request->getPost("cargo", "int");
                $Empleo->ubigeo_id = $this->request->getPost("ubigeo_id", "int");
                $Empleo->jornada = $this->request->getPost("jornada", "int");
                $Empleo->tipocontrato = $this->request->getPost("tipocontrato", "int");
                $Empleo->empresa = $this->session->get("auth")["id_empresa"];

                if ($this->request->getPost("fecha_creacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_creacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Empleo->fecha_creacion = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_clausura", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_clausura", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Empleo->fecha_clausura = date('Y-m-d', strtotime($fecha_new));
                }

                $Empleo->fecha_creacion = date('Y-m-d');

                $Empleo->salario = $this->request->getPost("salario", "float");
                $Empleo->cantidad_vacantes = $this->request->getPost("cantidad_vacantes", "int");
                //$Empleo->numero_vistas = $this->request->getPost("numero_vistas", "int");
                $Empleo->estado = "A";

                if ($Empleo->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empleo->getMessages());
                } else {

                    //create
                    //mkdir("adminpanel/archivos/empleos/files_" . $Empleo->id_empleo, 0700);

                    $nombre_fichero = "adminpanel/archivos/empleos/files_" . $Empleo->id_empleo;

                    if (file_exists($nombre_fichero)) {
                        //echo "El fichero $nombre_fichero existe";
                        //print("Directorio existe");
                        ///exit();
                    } else {
                        //echo "El fichero $nombre_fichero no existe";
                        //print("Directorio No existe");
                        //exit();

                        mkdir("adminpanel/archivos/empleos/files_" . $Empleo->id_empleo, 0700);
                    }

                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function getAjaxAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Cargo = Cargos::findFirstBycargo_id((int) $this->request->getPost("id", "int"));
            if ($Cargo) {
                $this->response->setJsonContent($Cargo->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Empleo = Empleos::findFirstByid_empleo((int) $this->request->getPost("id_empleo", "int"));
            if ($Empleo && $Empleo->estado = 'A') {
                $Empleo->estado = 'X';
                $Empleo->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function aplicaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $alumno = (string) $this->request->getPost("alumno", "string");
            $empleo = (int) $this->request->getPost("empleo", "int");
            $aplica = $this->request->getPost("aplica", "int");

            $P = Postulacion::findFirst("alumno = '{$alumno}' AND empleo = $empleo");

            // echo '<pre>';
            // print_r($P->estado);
            // exit();

            if ($P && $P->estado = 1) {
                $P->estado = $aplica;
                $P->save();

                $siono = "No Apto";
                if ($aplica == 2) {
                    $siono = "Apto";
                }

                $Profesional = Alumnos::findFirstBycodigo($alumno);
                $email_usuario = $Profesional->email1;

                $empleo = Empleos::findFirstByid_empleo($empleo);
                $empresa = Empresas::findFirstByid_empresa($empleo->empresa);

                // print("Razon Social:".$empresa->razon_social);
                // exit();

                $txt_adicional = "";
                if ($aplica == 2) {
                    $txt_adicional = " Datos de contacto de la empresa :  Representante: " . $empresa->representante . " , Razon Social: " . $empresa->razon_social . ", "
                        . " Email: " . $empresa->email . " , Telefono: " . $empresa->telefono;
                } else {
                    $txt_adicional = " usted puede seguir postulando a las diversas ofertas laborales de nuestra plataforma";
                }

                $text_body = " Estimado usuario su CV fue " . $siono . " en la oferta laboral titulada '" . $empleo->titulo . "' . "
                    . $txt_adicional;

                $from = $this->config->mail->from;
                $mailer_u = new mailer($this->di);
                $xAbrevIns = $this->config->global->xAbrevIns;
                $mailer_u->setSubject(" Evaluación de Solicitud de empleo ({$xAbrevIns} BOLSA DE TRABAJO) ");
                $mailer_u->setFrom($from);
                $mailer_u->setTo($email_usuario, $from);
                $mailer_u->setBody($text_body);

                if ($mailer_u->send()) {
                    //return true;
                } else {
                    echo $mailer_u->getError();
                    echo "error";
                }

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {

                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function datatableAction()
    {
        $admin = $this->session->get("auth")["nombres"];
        $admin_bolsa = $this->session->get("auth")["nombres"];
        if ($admin == 'ADMINISTRADOR DEL SISTEMA' or $admin_bolsa == 'BOLSA DE TRABAJO') {
            $this->view->disable();
            if ($this->request->isPOST() && $this->request->isAjax()) {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("e.id_empleo");
                $datatable->setSelect("e.id_empleo,r.descripcion as region , d.descripcion as distrito, c.nombres as cargo, j.descripcion as jornada, tc.descripcion as tipocontrato  "
                    . ",e.fecha_creacion,e.fecha_clausura,e.titulo,e.descripcion,e.salario,e.requisitos,e.cantidad_vacantes,e.numero_visitas AS numero_visitas,"
                    . " (SELECT COUNT(empleo) as postulo FROM tbl_btr_postulaciones WHERE empleo = e.id_empleo )  "
                    . ",e.estado");
                $datatable->setFrom("tbl_btr_empleos e INNER JOIN regiones r ON r.region = e.region_id "
                    . " INNER JOIN distritos d ON ( d.distrito = e.distrito_id AND d.region = e.region_id AND d.provincia = e.provincia_id ) "
                    . " INNER JOIN a_codigos c ON c.codigo = e.cargo "
                    . " INNER JOIN a_codigos j ON j.codigo = e.jornada "
                    . " INNER JOIN a_codigos tc ON tc.codigo = e.tipocontrato ");
                $datatable->setWhere("e.estado = 'A' AND c.numero = 45 AND j.numero = 46 AND tc.numero = 47 AND e.empresa=" . $this->session->get("auth")["usuario_id"]);
                $datatable->setOrderby("e.fecha_creacion ASC");
                $datatable->setParams($_POST);
                $datatable->getJson();
            }
        } elseif ($this->session->get("auth")["nombre_perfil"] == 'EMPRESAS') {
            //print("LLega id".$this->session->get("auth")["id_empresa"]);
            //exit();
            $this->view->disable();
            if ($this->request->isPOST() && $this->request->isAjax()) {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("e.id_empleo");
                $datatable->setSelect("e.id_empleo,r.descripcion as region , d.descripcion as distrito, c.nombres as cargo, j.descripcion as jornada, tc.descripcion as tipocontrato  "
                    . ",e.fecha_creacion,e.fecha_clausura,e.titulo,e.descripcion,e.salario,e.requisitos,e.cantidad_vacantes,e.numero_visitas AS numero_visitas,"
                    . " (SELECT COUNT(empleo) as postulo FROM tbl_btr_postulaciones WHERE empleo = e.id_empleo )  "
                    . ",e.estado");
                $datatable->setFrom("tbl_btr_empleos e INNER JOIN regiones r ON r.region = e.region_id "
                    . " INNER JOIN distritos d ON ( d.distrito = e.distrito_id AND d.region = e.region_id AND d.provincia = e.provincia_id ) "
                    . " INNER JOIN a_codigos c ON c.codigo = e.cargo "
                    . " INNER JOIN a_codigos j ON j.codigo = e.jornada "
                    . " INNER JOIN a_codigos tc ON tc.codigo = e.tipocontrato ");
                $datatable->setWhere("e.estado = 'A' AND c.numero = 45 AND j.numero = 46 AND tc.numero = 47 AND e.empresa=" . $this->session->get("auth")["id_empresa"]);
                $datatable->setOrderby("e.fecha_creacion ASC");
                $datatable->setParams($_POST);
                $datatable->getJson();
            }
        }
    }

    public function datatablegAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("e.id_empleo");
            $datatable->setSelect("e.id_empleo,r.descripcion as region ,emp.imagen , emp.razon_social , d.descripcion as distrito, c.nombres as cargod, j.nombres as jornada, tc.nombres as tipocontrato  "
                . ",e.fecha_creacion,e.fecha_clausura,e.titulo,e.descripcion,e.salario,e.requisitos,e.cantidad_vacantes,e.numero_visitas,"
                . " (SELECT COUNT(empleo) as postulo FROM tbl_btr_postulaciones WHERE empleo = e.id_empleo )  "
                . ",e.estado");
            $datatable->setFrom("tbl_btr_empleos e INNER JOIN regiones r ON r.region = e.region_id "
                . " INNER JOIN distritos d ON ( d.distrito = e.distrito_id AND d.region = e.region_id AND d.provincia = e.provincia_id ) "
                . " INNER JOIN tbl_btr_empresas emp ON emp.id_empresa = e.empresa "
                . " INNER JOIN a_codigos c ON c.codigo = e.cargo "
                . " INNER JOIN a_codigos j ON j.codigo = e.jornada "
                . " INNER JOIN a_codigos tc ON tc.codigo = e.tipocontrato ");
            $datatable->setWhere("e.estado = 'A' AND c.numero = 45 AND j.numero = 46 AND tc.numero = 47");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function tblpostulantesAction($id)
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo_postulacion");
            $datatable->setSelect("codigo_postulacion,fullname, empleo,celular_alumno, dni, email_alumno, tipo_alumno,cv, estado");
            $datatable->setFrom("(SELECT p.alumno AS codigo_postulacion,p.empleo,al.celular AS celular_alumno,al.nro_doc AS dni,a_c.nombres AS tipo_alumno,al.email1 AS email_alumno,p.cv_referencia AS cv,p.estado,CONCAT  (al.apellidop,' ', al.apellidom,' ',al.nombres) AS fullname
FROM tbl_btr_postulaciones AS p INNER JOIN alumnos al ON al.codigo = p.alumno INNER JOIN a_codigos a_c ON al.tipo = a_c.codigo WHERE a_c.numero= 16) AS tempx");
            $datatable->setWhere("empleo = " . $id);
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
}
