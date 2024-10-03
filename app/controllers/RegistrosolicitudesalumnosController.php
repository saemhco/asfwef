<?php

class RegistrosolicitudesalumnosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/registrosolicitudesalumnos.js?v=" . uniqid());
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
        $perfil = $auth["perfil"];

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, semestre, alumno, numero, fullname, mensaje, area, perfil, archivo, estado,numero_tipo,tipo_solicitud");
            $datatable->setFrom("(SELECT
                                    al.codigo AS codigo,
                                    a_so.semestre AS semestre,
                                    a_so.alumno AS alumno,
                                    a_so.numero AS numero,
                                    CONCAT ( al.apellidop, ' ', al.apellidom, ' ', al.nombres ) AS fullname,
                                    a_so.descripcion AS mensaje,
                                    ar.nombres AS area,
                                    a_so.archivo AS archivo,
                                    a_so.estado AS estado,
                                    t_s.numero AS numero_tipo,
                                    t_s.nombres AS tipo_solicitud,
                                    ar.perfil AS perfil
                                    FROM
                                    alumnos AS al
                                    INNER JOIN tbl_reg_alumnos_solicitudes AS a_so ON a_so.alumno = al.codigo
                                    INNER JOIN a_codigos AS t_s ON a_so.tipo = t_s.codigo
                                    INNER JOIN tbl_web_areas AS ar ON a_so.area = ar.codigo) AS temporal_table");
            //$datatable->setWhere("perfil ={$perfil}");
            $datatable->setWhere("perfil = 8 OR perfil= 6 AND numero_tipo = 64");
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

}
