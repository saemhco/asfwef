<?php

class GestionsolicitudesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function solicitudesrecibidasAction() {

        $this->assets->addJs("adminpanel/js/modulos/gestionsolicitudes.solicitudesrecibidas.js?v=" . uniqid());
    }

    public function datatableSolicitudesrecibidasAction() {
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        $semestre_m = $semestre->codigo;

        $auth = $this->session->get('auth');
        $perfil = $auth["perfil"];

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, semestre, alumno, numero, fullname, mensaje, archivo, estado,numero_tipo,tipo_solicitud, fecha");
            $datatable->setFrom("(SELECT
            al.codigo AS codigo,
            a_so.semestre AS semestre,
            a_so.alumno AS alumno,
            a_so.numero AS numero,
            CONCAT ( al.apellidop, ' ', al.apellidom, ' ', al.nombres ) AS fullname,
            a_so.descripcion AS mensaje,                                    
            a_so.archivo AS archivo,
            a_so.estado AS estado,
            a_so.fecha AS fecha,
            t_s.numero AS numero_tipo,
            t_s.nombres AS tipo_solicitud                                    
            FROM
            alumnos AS al
            INNER JOIN tbl_reg_alumnos_solicitudes AS a_so ON a_so.alumno = al.codigo
            INNER JOIN a_codigos AS t_s ON a_so.tipo = t_s.codigo                                    
            WHERE t_s.numero = 64) AS temporal_table");
            //$datatable->setWhere("perfil ={$perfil}");
            //$datatable->setWhere("perfil = 8 OR perfil= 6");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function solicitudesrecibidasbecasAction() {

        $this->assets->addJs("adminpanel/js/modulos/gestionsolicitudes.solicitudesrecibidasbecas.js?v=" . uniqid());
    }

    //becas
    public function datatableSolicitudesrecibidasbecasAction() {
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        $semestre_m = $semestre->codigo;

        $auth = $this->session->get('auth');
        $perfil = $auth["perfil"];

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, semestre, alumno, numero, fullname, mensaje, archivo, estado,numero_tipo,tipo_solicitud, fecha");
            $datatable->setFrom("(SELECT
            al.codigo AS codigo,
            a_so.semestre AS semestre,
            a_so.alumno AS alumno,
            a_so.numero AS numero,
            CONCAT ( al.apellidop, ' ', al.apellidom, ' ', al.nombres ) AS fullname,
            a_so.descripcion AS mensaje,                                    
            a_so.archivo AS archivo,
            a_so.estado AS estado,
            a_so.fecha AS fecha,
            t_s.numero AS numero_tipo,
            t_s.nombres AS tipo_solicitud                                    
            FROM
            alumnos AS al
            INNER JOIN tbl_reg_alumnos_solicitudes_becas AS a_so ON a_so.alumno = al.codigo
            INNER JOIN a_codigos AS t_s ON a_so.tipo = t_s.codigo                                    
            WHERE t_s.numero = 149) AS temporal_table");
            //$datatable->setWhere("perfil ={$perfil}");
            //$datatable->setWhere("perfil = 8 OR perfil= 6");
            $datatable->setOrderby("fecha DESC");
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


    //mensaje beca
    public function mensajebecaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            $AlumnosSolicitudes = AlumnosSolicitudesBecas::findFirst(
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


    //aprobar
    public function aprobarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            //verifica si existe registro en tabla: alumnos_semestre
            $verifica = AlumnosSemestre::find("semestre = {$semestre} AND alumno='{$alumno}' ");
            if (count($verifica) >= 1) {

                $db_update = $this->db;
                $sql_update_a_s = " UPDATE alumnos_semestre  SET resolucion_matricula_especial = '1' "
                        . "WHERE semestre = {$semestre} AND alumno = '{$alumno}' ";
                $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);

                //alumnos solicitudes
                $AlumnosSolicitudes = AlumnosSolicitudes::findFirst(
                                [
                                    "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                                ]
                );

                if ($AlumnosSolicitudes->estado == 1) {
                    $AlumnosSolicitudes->estado = 2;
                    $AlumnosSolicitudes->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no"));
                }
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_start"));
            }
            //

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    //aprobar beca
    public function aprobarbecaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            //verifica si existe registro en tabla: alumnos_semestre
            $verifica = AlumnosSemestre::find("semestre = {$semestre} AND alumno='{$alumno}' ");
            if (count($verifica) >= 1) {

                /*$db_update = $this->db;
                $sql_update_a_s = " UPDATE alumnos_semestre  SET resolucion_matricula_especial = '1' "
                        . "WHERE semestre = {$semestre} AND alumno = '{$alumno}' ";
                $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);*/

                //alumnos solicitudes
                $AlumnosSolicitudes = AlumnosSolicitudesBecas::findFirst(
                                [
                                    "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                                ]
                );

                if ($AlumnosSolicitudes->estado == 1) {
                    $AlumnosSolicitudes->estado = 2;
                    $AlumnosSolicitudes->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no"));
                }
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_start"));
            }
            //

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //denegar
    public function denegarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            //verifica si existe registro en tabla: alumnos_semestre
            $verifica = AlumnosSemestre::find("semestre = {$semestre} AND alumno='{$alumno}' ");
            if (count($verifica) >= 1) {

                $db_update = $this->db;
                $sql_update_a_s = " UPDATE alumnos_semestre  SET resolucion_matricula_especial = '0' "
                        . "WHERE semestre = {$semestre} AND alumno = '{$alumno}' ";
                $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);

                //alumnos solicitudes
                $AlumnosSolicitudes = AlumnosSolicitudes::findFirst(
                                [
                                    "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                                ]
                );

                if ($AlumnosSolicitudes->estado == 1) {
                    $AlumnosSolicitudes->estado = 3;
                    $AlumnosSolicitudes->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no"));
                }
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_start"));
            }
            //

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    //denegar beca
    public function denegarbecaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            //verifica si existe registro en tabla: alumnos_semestre
            $verifica = AlumnosSemestre::find("semestre = {$semestre} AND alumno='{$alumno}' ");
            if (count($verifica) >= 1) {

                /*$db_update = $this->db;
                $sql_update_a_s = " UPDATE alumnos_semestre  SET resolucion_matricula_especial = '0' "
                        . "WHERE semestre = {$semestre} AND alumno = '{$alumno}' ";
                $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);*/

                //alumnos solicitudes
                $AlumnosSolicitudes = AlumnosSolicitudesBecas::findFirst(
                                [
                                    "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                                ]
                );

                if ($AlumnosSolicitudes->estado == 1) {
                    $AlumnosSolicitudes->estado = 3;
                    $AlumnosSolicitudes->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no"));
                }
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_start"));
            }
            //

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //----------------------------alumnos---------------------------------------
    public function registrosacademicosAction() {



        $tipo_solicitud_alumno = TipoSolicitudAlumno::find("estado = 'A' AND numero = 64 ");
        $this->view->tipo_solicitud_alumno = $tipo_solicitud_alumno;

        //tipo de solicitud del alumno
        $destinatario = Destinatario::find("perfil > 0");
//        foreach ($destinatario as $value) {
//            echo '<pre>';
//            print_r($value->nombres);
//            
//        }
//        exit();
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
        $this->assets->addJs("adminpanel/js/modulos/gestionsolicitudes.registrosacademicos.js?v" . uniqid());
    }


    //----------------------------alumnos becas---------------------------------------
    public function registrosbecasAction() {



        $tipo_solicitud_alumno_becas = TipoSolicitudAlumno::find("estado = 'A' AND numero = 149 ");
        $this->view->tipo_solicitud_alumno_becas = $tipo_solicitud_alumno_becas;

        //tipo de solicitud del alumno
        $destinatario = Destinatario::find("perfil > 0");
//        foreach ($destinatario as $value) {
//            echo '<pre>';
//            print_r($value->nombres);
//            
//        }
//        exit();
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
        $this->assets->addJs("adminpanel/js/modulos/gestionsolicitudes.registrosbecas.js?v" . uniqid());
    }


    //new solicitudes
    public function getNewAlumnosSolicitudesAction() {
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


    //new solicitudes becas
    public function getNewAlumnosSolicitudesbecasAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");

            $AlumnosSolicitudes = AlumnosSolicitudesBecas::count(
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

    public function saveRegistrosacademicosAction() {


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
                $AlumnosSolicitudes->tipo = $this->request->getPost("tipo", "int");
                $AlumnosSolicitudes->descripcion = $this->request->getPost("descripcion", "string");
                $AlumnosSolicitudes->estado = 1;
                $AlumnosSolicitudes->fecha = date("Y-m-d H:i:s");

                //fecha y hora (falta)


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



                                        $url_destino = 'adminpanel/archivos/solicitudes/alumnos/FILE-RA-' . $AlumnosSolicitudes->archivo;

                                        //echo '<pre>';
                                        //print_r($url_destino);
                                        //exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/solicitudes/alumnos/FILE-RA-' . $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '-' . $temporal_rand . '.pdf';
                                        $AlumnosSolicitudes->archivo = $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/solicitudes/alumnos/FILE-RA-' . $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '.pdf';
                                        $AlumnosSolicitudes->archivo = $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '.pdf';
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


    //save registro solicitudes becas
    public function saveRegistrosbecasAction() {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $semestre = (int) $this->request->getPost("semestre", "int");
                $alumno = (string) $this->request->getPost("alumno", "string");
                $numero = (int) $this->request->getPost("numero", "int");

                $AlumnosSolicitudes = AlumnosSolicitudesBecas::findFirst(
                                [
                                    "semestre = {$semestre} AND alumno = '{$alumno}' AND numero = {$numero}"
                                ]
                );
                //Valida cuando es nuevo
                $AlumnosSolicitudes = (!$AlumnosSolicitudes) ? new AlumnosSolicitudesBecas() : $AlumnosSolicitudes;


                $AlumnosSolicitudes->semestre = $this->request->getPost("semestre", "int");
                $AlumnosSolicitudes->alumno = $this->request->getPost("alumno", "string");
                $AlumnosSolicitudes->numero = $this->request->getPost("numero", "int");
                $AlumnosSolicitudes->tipo = $this->request->getPost("tipo", "int");
                $AlumnosSolicitudes->descripcion = $this->request->getPost("descripcion", "string");
                $AlumnosSolicitudes->estado = 1;
                $AlumnosSolicitudes->fecha = date("Y-m-d H:i:s");

               
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



                                        $url_destino = 'adminpanel/archivos/solicitudes/becas/FILE-BE-' . $AlumnosSolicitudes->archivo;

                                        //echo '<pre>';
                                        //print_r($url_destino);
                                        //exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/solicitudes/becas/FILE-BE-' . $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '-' . $temporal_rand . '.pdf';
                                        $AlumnosSolicitudes->archivo = $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/solicitudes/becas/FILE-BE-' . $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '.pdf';
                                        $AlumnosSolicitudes->archivo = $AlumnosSolicitudes->numero . '-' . $AlumnosSolicitudes->semestre . '-' . $AlumnosSolicitudes->alumno . '.pdf';
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

    public function getAjaxAlumnosSolicitudesAction() {
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

    //BECAS
    public function getAjaxAlumnosSolicitudesbecasAction() {
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

    public function eliminarAlumnosSolicitudesAction() {
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

    //beas
    public function eliminarAlumnosSolicitudesbecasAction() {
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

    public function datatableRegistrosacademicosAction() {
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
            $datatable->setSelect("a_so.semestre,a_so.alumno, a_so.tipo, a_so.numero, a_so.descripcion, a_so.estado, a_so.archivo,t.nombres AS tipo, a_so.fecha");
            $datatable->setFrom("tbl_reg_alumnos_solicitudes a_so "
                    . "INNER JOIN a_codigos t ON t.codigo = a_so.tipo");
            $datatable->setWhere("t.numero = 64 AND a_so.semestre ={$semestre_m} AND a_so.alumno = '{$alumno}' ");
            $datatable->setOrderby("a_so.fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //tabla registro becas
    public function datatableRegistrosbecasAction() {
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
            $datatable->setSelect("a_so.semestre,a_so.alumno, a_so.tipo, a_so.numero, a_so.descripcion, a_so.estado, a_so.archivo,t.nombres AS tipo, a_so.fecha");
            $datatable->setFrom("tbl_reg_alumnos_solicitudes_becas a_so "
                    . "INNER JOIN a_codigos t ON t.codigo = a_so.tipo");
            $datatable->setWhere("t.numero = 149 AND a_so.semestre ={$semestre_m} AND a_so.alumno = '{$alumno}' ");
            $datatable->setOrderby("a_so.fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //mensaje solicitudes becas
    public function mensajeAlumnosSolicitudesbecasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $numero = (int) $this->request->getPost("numero", "int");

            $AlumnosSolicitudes = AlumnosSolicitudesBecas::findFirst(
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


    //mensaje
    public function mensajeAlumnosSolicitudesAction() {
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

    public function bienestaruniversitarioAction() {



        $servicios = Servicios::find("estado = 'A' ORDER BY titular ASC");
        $this->view->servicios = $servicios;

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
        $this->assets->addJs("adminpanel/js/modulos/gestionsolicitudes.bienestaruniversitario.js?v" . uniqid());
    }

    public function savebienestaruniversitarioAction() {


        // echo "<pre>";
        // print_r($_POST);
        // exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_solicitud_servicio", "int");
                $SolicitudServicios = SolicitudServicios::findFirstByid_solicitud_servicio($id);
                $SolicitudServicios = (!$SolicitudServicios) ? new SolicitudServicios() : $SolicitudServicios;



                $SolicitudServicios->id_semestre = $this->request->getPost("id_semestre", "int");
                $SolicitudServicios->id_alumno = $this->request->getPost("id_alumno", "string");
                $SolicitudServicios->id_servicio = $this->request->getPost("id_servicio", "int");
                $SolicitudServicios->fecha_hora = date("Y-m-d H:i:s");
                $SolicitudServicios->asunto = $this->request->getPost("asunto", "string");
                $SolicitudServicios->estado = '1';



                if ($SolicitudServicios->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($SolicitudServicios->getMessages());
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
                                    if (isset($SolicitudServicios->archivo)) {



                                        $url_destino = 'adminpanel/archivos/solicitudes/alumnos/FILE-BU-' . $SolicitudServicios->archivo;

                                        //echo '<pre>';
                                        //print_r($url_destino);
                                        //exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/solicitudes/alumnos/FILE-BU-' . $SolicitudServicios->id_solicitud_servicio . '-' . $SolicitudServicios->id_semestre . '-' . $SolicitudServicios->id_alumno . '-' . $temporal_rand . '.pdf';
                                        $SolicitudServicios->archivo = $SolicitudServicios->id_solicitud_servicio . '-' . $SolicitudServicios->id_semestre . '-' . $SolicitudServicios->id_alumno . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/solicitudes/alumnos/FILE-BU-' . $SolicitudServicios->id_solicitud_servicio . '-' . $SolicitudServicios->id_semestre . '-' . $SolicitudServicios->id_alumno . '.pdf';
                                        $SolicitudServicios->archivo = $SolicitudServicios->id_solicitud_servicio . '-' . $SolicitudServicios->id_semestre . '-' . $SolicitudServicios->id_alumno . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$SolicitudServicios->imagen = 'IMG' . '-' . $SolicitudServicios->id_documento . ".jpg";
                                    }
                                }
                            }
                        }

                        $SolicitudServicios->save();
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


    public function datatableBienestaruniversitarioAction() {
                    
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
            $datatable->setColumnaId("id_solicitud_servicio");
            $datatable->setSelect("ss.id_solicitud_servicio, ss.fecha_hora, ws.titular,ss.asunto,ss.estado,ss.archivo");
            $datatable->setFrom("tbl_dbu_solicitud_servicios ss "
                    . "INNER JOIN public.tbl_web_servicios ws ON ws.id_servicio = ss.id_servicio");
            $datatable->setWhere("ss.id_semestre ={$semestre_m} AND ss.id_alumno = '{$alumno}' ");
            $datatable->setOrderby("ss.fecha_hora DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
            }



        /*
        $this->view->disable();

        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_solicitud_servicio");
            $datatable->setSelect("id_solicitud_servicio, fecha_hora, titular,asunto,estado,archivo");
            $datatable->setFrom("(SELECT
            public.tbl_dbu_solicitud_servicios.id_solicitud_servicio,
            to_char(public.tbl_dbu_solicitud_servicios.fecha_hora, 'DD/MM/YYYY') AS fecha_hora,
            public.tbl_web_servicios.titular,
            public.tbl_dbu_solicitud_servicios.asunto,
            public.tbl_dbu_solicitud_servicios.estado,
            public.tbl_dbu_solicitud_servicios.archivo
            FROM
            public.tbl_dbu_solicitud_servicios
            INNER JOIN public.tbl_web_servicios ON public.tbl_web_servicios.id_servicio = public.tbl_dbu_solicitud_servicios.id_servicio
            WHERE
            public.tbl_dbu_solicitud_servicios.estado = 'A') AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
        */
        
    }

        //mensaje
        public function mensajeBienestaruniversitarioAction() {
            $this->view->disable();
            if ($this->request->isPost() && $this->request->isAjax()) {
    
                $id_solicitud_servicio = (int) $this->request->getPost("id_solicitud_servicio", "int");

    
                $SolicitudServicios = SolicitudServicios::findFirst(
                                [
                                    "id_solicitud_servicio = {$id_solicitud_servicio}"
                                ]
                );
    
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("asunto" => $SolicitudServicios->asunto));
                $this->response->send();
            } else {
                $this->response->setStatusCode(404);
            }
        }


}
