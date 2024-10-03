<?php

class AlumnossolicitudesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/alumnossolicitudes.js?v" . uniqid());

        $tipo_solicitud_alumno = TipoSolicitudAlumno::find("estado = 'A' AND numero = 64 ");
        $this->view->tipo_solicitud_alumno = $tipo_solicitud_alumno;

        //tipo de solicitud del alumno
        $destinatario = Destinatario::find("perfil > 0");
        $this->view->destinatario = $destinatario;

        //semestre actual
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        $semestre_m = $semestre->codigo;
        $this->view->semestre = $semestre_m;


        $auth = $this->session->get('auth');
        $alumno = $auth["codigo"];

        //echo '<pre>';
        //print_r($alumno);
        //exit();

        $this->view->alumno = $alumno;
    }

    //new
    public function getNewAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");

            $AlumnosSolicitudes = AlumnosSolicitudes::count(
                            [
                                "semestre = {$semestre} AND alumno = '{$alumno}'"
                            ]
            );

            //echo '<pre>';
            //print_r($AlumnosSolicitudes);
            //exit();

            if ($AlumnosSolicitudes >= 0) {
                $numero = $AlumnosSolicitudes + 1;
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "si", "numero" => $numero));
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveAction() {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $semestre = (int) $this->request->getPost("semestre", "int");
                $alumno = (string) $this->request->getPost("alumno", "string");
                $numero = (int) $this->request->getPost("numero", "int");

                $AlumnosSolicitudes = AlumnosSolicitudes::findFirst(
                                [
                                    "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                                ]
                );
                //Valida cuando es nuevo
                $AlumnosSolicitudes = (!$AlumnosSolicitudes) ? new AlumnosSolicitudes() : $AlumnosSolicitudes;


                $AlumnosSolicitudes->semestre = $this->request->getPost("semestre", "int");
                $AlumnosSolicitudes->alumno = $this->request->getPost("alumno", "string");
                $AlumnosSolicitudes->numero = $this->request->getPost("numero", "int");
                $AlumnosSolicitudes->area = $this->request->getPost("area", "int");
                $AlumnosSolicitudes->tipo = $this->request->getPost("tipo", "int");
                $AlumnosSolicitudes->descripcion = $this->request->getPost("descripcion", "string");
                $AlumnosSolicitudes->estado = 1;

                if ($AlumnosSolicitudes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AlumnosSolicitudes->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($AlumnosSolicitudes->archivo)) {



                                        $url_destino = 'adminpanel/archivos/solicitudes/FILE-' . $AlumnosSolicitudes->archivo;

                                        //echo '<pre>';
                                        //print_r($url_destino);
                                        //exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/solicitudes/FILE-' . $AlumnosSolicitudes->alumno . '-' . $AlumnosSolicitudes->numero . '-' . $temporal_rand . '.pdf';
                                        $AlumnosSolicitudes->archivo = $AlumnosSolicitudes->alumno . '-' . $AlumnosSolicitudes->numero . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/solicitudes/FILE-' . $AlumnosSolicitudes->alumno . '-' . $AlumnosSolicitudes->numero . '.pdf';
                                        $AlumnosSolicitudes->archivo = $AlumnosSolicitudes->alumno . '-' . $AlumnosSolicitudes->numero . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$AlumnosSolicitudes->imagen = 'IMG' . '-' . $AlumnosSolicitudes->id_documento . ".jpg";
                                    }
                                }
                            }
                        }

                        $AlumnosSolicitudes->save();
                    }



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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Empresas = Empresas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Empresas) {
                $this->response->setJsonContent($Empresas->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Empresas = Empresas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Empresas && $Empresas->estado = 'A') {
                $Empresas->estado = 'X';
                $Empresas->save();
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

    public function datatableAction() {
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        $semestre_m = $semestre->codigo;

        $auth = $this->session->get('auth');
        $alumno = $auth["codigo"];

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("a_so.semestre");
            $datatable->setSelect("a_so.semestre,a_so.alumno, a_so.tipo, a_so.numero, a_so.descripcion, a_so.estado, a_so.archivo,t.nombres AS tipo");
            $datatable->setFrom("tbl_reg_alumnos_solicitudes a_so "
                    . "INNER JOIN a_codigos t ON t.codigo = a_so.tipo");
            $datatable->setWhere("t.numero = 64 AND a_so.semestre ={$semestre_m} AND a_so.alumno = '{$alumno}' ");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //mensaje
    public function mensajeAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            $AlumnosSolicitudes = AlumnosSolicitudes::findFirst(
                            [
                                "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                            ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje" => $AlumnosSolicitudes->descripcion));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

}
