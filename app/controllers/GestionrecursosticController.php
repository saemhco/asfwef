<?php

class GestionrecursosticController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionrecursostic.js?v=" . uniqid() . "");
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal_area");
            $datatable->setSelect("id_personal_area,personal_nombre,nombre_area, cargo, estado, estado_a, estado_pa");
            $datatable->setFrom("view_personal_area");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("personal_nombre ASC, cargo ASC, estado_pa");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $personalAreas = PersonalAreas::findFirstByid_personal_area((int) $id);
            // print($personalAreas->id_personal_area);
            // exit();
        }

        $this->view->personalAreas = $personalAreas;

        //computadoras
        $computadoras = Computadoras::find(
            [
                "estado = 'A'",
                'order' => 'id_computadora ASC',
            ]
        );
        $this->view->computadoras = $computadoras;

        //impresoras
        $impresoras = Impresoras::find(
            [
                "estado = 'A'",
                'order' => 'id_impresora ASC',
            ]
        );
        $this->view->impresoras = $impresoras;

        //estabilizadores
        $estabilizadores = Estabilizadores::find(
            [
                "estado = 'A'",
                'order' => 'id_estabilizador ASC',
            ]
        );
        $this->view->estabilizadores = $estabilizadores;

        //pantallas
        $pantallas = Pantallas::find(
            [
                "estado = 'A'",
                'order' => 'id_pantalla ASC',
            ]
        );
        $this->view->pantallas = $pantallas;

        $conservacion = Conservacion::find("estado = 'A' AND numero = 97");
        $this->view->conservacion = $conservacion;



        $personal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop, apellidom, nombres',
            ]
        );
        $this->view->personal = $personal;

        $areaPersonalCargo = VPersonalArea::find(
            [
                "estado = 'A'",
                'order' => 'personal_nombre ASC',
            ]
        );
        $this->view->area_personal_cargo = $areaPersonalCargo;



        $ubicacion = Areas::find(
            [
                "estado = 'A'",
                'order' => 'nombres ASC',
            ]
        );
        $this->view->ubicacion = $ubicacion;

        $this->assets->addJs("adminpanel/js/modulos/gestionrecursostic.recursostic.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/gestionrecursostic.computadoras.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/gestionrecursostic.impresoras.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/gestionrecursostic.estabilizadores.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/gestionrecursostic.pantallas.js?v=" . uniqid());
    }

    public function datatableComputadorasAction($id_personal_area)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal_area_equipo");
            $datatable->setSelect("id_personal_area_equipo,id_computadora,tipo,marca,modelo,serie,color, estado,id_patrimonial,nombres");
            $datatable->setFrom("(SELECT
            public.tbl_web_personal_areas_equipos.id_personal_area_equipo AS id_personal_area_equipo,
            public.tbl_eqp_computadoras.id_computadora,
            public.tbl_eqp_computadoras.tipo,
            public.tbl_eqp_computadoras.marca,
            public.tbl_eqp_computadoras.modelo,
            public.tbl_eqp_computadoras.serie,
            public.tbl_eqp_computadoras.color,
            public.tbl_web_personal_areas_equipos.estado,
            public.tbl_eqp_computadoras.id_patrimonial,
            public.a_codigos.nombres
            FROM
            public.tbl_eqp_computadoras
            INNER JOIN public.tbl_web_personal_areas_equipos ON public.tbl_eqp_computadoras.id_computadora = public.tbl_web_personal_areas_equipos.id_tabla
            INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_computadoras.tipo
            WHERE
            public.tbl_web_personal_areas_equipos.id_personal_area = $id_personal_area AND
            public.tbl_web_personal_areas_equipos.tipo = 1 AND public.a_codigos.numero = 101) AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_patrimonial, marca, modelo, serie");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveComputadorasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area_equipo", "int");
                $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);
                $personalAreasEquipos = (!$personalAreasEquipos) ? new PersonalAreasEquipos() : $personalAreasEquipos;

                $personalAreasEquipos->id_personal_area = $this->request->getPost("id_personal_area", "int");
                $personalAreasEquipos->tabla = "tbl_eqp_computadoras";
                $personalAreasEquipos->id_tabla = $this->request->getPost("id_tabla", "int");
                $personalAreasEquipos->tipo = 1;

                if ($this->request->getPost("conservacion", "int") == "") {
                    $personalAreasEquipos->conservacion = null;
                } else {
                    $personalAreasEquipos->conservacion = $this->request->getPost("conservacion", "int");
                }

                $personalAreasEquipos->ubicacion = $this->request->getPost("ubicacion", "string");
                $personalAreasEquipos->observaciones = $this->request->getPost("observaciones", "string");

                $personalAreasEquipos->usuario = $this->request->getPost("usuario", "string");
                $personalAreasEquipos->nombre = $this->request->getPost("nombre", "string");
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $personalAreasEquipos->teamviewer = $this->request->getPost("teamviewer", "string");
                $personalAreasEquipos->anydesk = $this->request->getPost("anydesk", "string");
                $personalAreasEquipos->ip = $this->request->getPost("ip", "string");

                $personalAreasEquipos->estado = "A";

                if ($personalAreasEquipos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($personalAreasEquipos->getMessages());
                } else {

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

    public function getAjaxValidarComputadorasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $id_tabla = (int) $this->request->getPost("id_tabla", "int");
            $id_tabla_hidden = (int) $this->request->getPost("id_tabla_hidden", "int");
            $id_personal_area = (int) $this->request->getPost("id_personal_area", "int");


            if ($id_tabla == $id_tabla_hidden) {

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                //$obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_computadoras' AND id_personal_area = {$id_personal_area} AND id_tabla = {$id_tabla} AND tipo = 1 AND estado = 'A'");

                $obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_computadoras' AND id_tabla = {$id_tabla} AND tipo = 1 AND estado = 'A'");


                if ($obj) {

                    // print("existe");
                    // exit();

                    // print($obj->id_personal_area);
                    // exit();




                    $db = $this->db;
                    $sql_query = "SELECT
                    public.tbl_web_areas.nombres AS area_nombre,
                    CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre
                    FROM
                    public.tbl_web_personal_areas
                    INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
                    INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_personal_areas.area
                    WHERE
                    public.tbl_web_personal_areas.id_personal_area = $obj->id_personal_area";

                    // print($sql_query);
                    // exit();

                    $sql_query_result = $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

                    // echo"<pre>";
                    // print_r($sql_query_result->area_nombre." - ".$sql_query_result->personal_nombre);
                    // exit();

                    $area = $sql_query_result->area_nombre;
                    $personal = $sql_query_result->personal_nombre;

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe", "area" => $area, "personal" => $personal));
                    $this->response->send();
                } else {

                    // print("no existe");
                    // exit();

                    //$this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxUsuariosComputadorasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $obj = PersonalAreasEquipos::findFirstByid_personal_area_equipo((int) $this->request->getPost("id", "int"));

            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarUsuariosComputadorasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            echo '<pre>';
            print_r($_POST);
            exit();

            $id = (int) $this->request->getPost("id", "int");
            $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);

            if ($personalAreasEquipos && $personalAreasEquipos->estado = 'A') {
                $personalAreasEquipos->estado = 'X';
                $personalAreasEquipos->save();
                //$this->db->delete("tbl_seg_usuarios_detalles", "id_usuario_detalle = {$id_usuario_detalle}");
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

    //-------------------------------------------------impresoras----------------------------------------------
    public function datatableImpresorasAction($id_personal_area)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal_area_equipo");
            $datatable->setSelect("id_personal_area_equipo,id_impresora,tipo,marca,modelo,serie,color, estado, id_patrimonial, nombres");
            $datatable->setFrom("(SELECT
            public.tbl_web_personal_areas_equipos.id_personal_area_equipo AS id_personal_area_equipo,
            public.tbl_eqp_impresoras.id_impresora,
            public.tbl_eqp_impresoras.tipo,
            public.tbl_eqp_impresoras.marca,
            public.tbl_eqp_impresoras.modelo,
            public.tbl_eqp_impresoras.serie,
            public.tbl_eqp_impresoras.color,
            public.tbl_web_personal_areas_equipos.estado AS estado,
            public.tbl_eqp_impresoras.id_patrimonial,
            public.a_codigos.nombres
            FROM
            public.tbl_eqp_impresoras
            INNER JOIN public.tbl_web_personal_areas_equipos ON public.tbl_eqp_impresoras.id_impresora = public.tbl_web_personal_areas_equipos.id_tabla
            INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_impresoras.tipo
            WHERE
            public.tbl_web_personal_areas_equipos.id_personal_area = $id_personal_area AND
            public.tbl_web_personal_areas_equipos.tipo = 2 AND public.a_codigos.numero = 100) AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_patrimonial, marca, modelo, serie");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveImpresorasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area_equipo", "int");
                $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);
                $personalAreasEquipos = (!$personalAreasEquipos) ? new PersonalAreasEquipos() : $personalAreasEquipos;

                $personalAreasEquipos->id_personal_area = $this->request->getPost("id_personal_area", "int");
                $personalAreasEquipos->tabla = "tbl_eqp_impresoras";
                $personalAreasEquipos->id_tabla = $this->request->getPost("id_tabla", "int");
                $personalAreasEquipos->tipo = 2;

                if ($this->request->getPost("conservacion", "int") == "") {
                    $personalAreasEquipos->conservacion = null;
                } else {
                    $personalAreasEquipos->conservacion = $this->request->getPost("conservacion", "int");
                }

                $personalAreasEquipos->ubicacion = $this->request->getPost("ubicacion", "string");
                $personalAreasEquipos->observaciones = $this->request->getPost("observaciones", "string");

                $personalAreasEquipos->usuario = $this->request->getPost("usuario", "string");
                $personalAreasEquipos->nombre = $this->request->getPost("nombre", "string");
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $personalAreasEquipos->teamviewer = $this->request->getPost("teamviewer", "string");
                $personalAreasEquipos->anydesk = $this->request->getPost("anydesk", "string");
                $personalAreasEquipos->ip = $this->request->getPost("ip", "string");

                $personalAreasEquipos->estado = "A";

                if ($personalAreasEquipos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($personalAreasEquipos->getMessages());
                } else {

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

    public function getAjaxValidarImpresorasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $id_tabla = (int) $this->request->getPost("id_tabla", "int");
            $id_tabla_hidden = (int) $this->request->getPost("id_tabla_hidden", "int");
            $id_personal_area = (int) $this->request->getPost("id_personal_area", "int");


            if ($id_tabla == $id_tabla_hidden) {

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                //$obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_impresoras' AND id_personal_area = {$id_personal_area} AND id_tabla = {$id_tabla} AND tipo = 2 AND estado = 'A'");

                $obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_impresoras' AND id_tabla = {$id_tabla} AND tipo = 2 AND estado = 'A'");


                if ($obj) {

                    // print("existe");
                    // exit();

                    $db = $this->db;
                    $sql_query = "SELECT
                    public.tbl_web_areas.nombres AS area_nombre,
                    CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre
                    FROM
                    public.tbl_web_personal_areas
                    INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
                    INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_personal_areas.area
                    WHERE
                    public.tbl_web_personal_areas.codigo = $obj->id_personal_area";

                    // print($sql_query);
                    // exit();

                    $sql_query_result = $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

                    // echo"<pre>";
                    // print_r($sql_query_result->area_nombre." - ".$sql_query_result->personal_nombre);
                    // exit();

                    $area = $sql_query_result->area_nombre;
                    $personal = $sql_query_result->personal_nombre;

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe", "area" => $area, "personal" => $personal));
                    $this->response->send();
                } else {

                    //print("no existe");
                    //exit();

                    //$this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxUsuariosImpresorasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $obj = PersonalAreasEquipos::findFirstByid_personal_area_equipo((int) $this->request->getPost("id", "int"));

            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarUsuariosImpresorasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            echo '<pre>';
            print_r($_POST);
            exit();

            $id = (int) $this->request->getPost("id", "int");
            $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);

            if ($personalAreasEquipos && $personalAreasEquipos->estado = 'A') {
                $personalAreasEquipos->estado = 'X';
                $personalAreasEquipos->save();
                //$this->db->delete("tbl_seg_usuarios_detalles", "id_usuario_detalle = {$id_usuario_detalle}");
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

    //---------------------------------------------estabilizadores-----------------------------------------------
    public function datatableEstabilizadoresAction($id_personal_area)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal_area_equipo");
            $datatable->setSelect("id_personal_area_equipo,id_estabilizador,tipo,marca,modelo,serie,color, estado, id_patrimonial,nombres");
            $datatable->setFrom("(SELECT
            public.tbl_web_personal_areas_equipos.id_personal_area_equipo AS id_personal_area_equipo,
            public.tbl_eqp_estabilizadores.id_estabilizador,
            public.tbl_eqp_estabilizadores.tipo,
            public.tbl_eqp_estabilizadores.marca,
            public.tbl_eqp_estabilizadores.modelo,
            public.tbl_eqp_estabilizadores.serie,
            public.tbl_eqp_estabilizadores.color,
            public.tbl_web_personal_areas_equipos.estado AS estado,
            public.a_codigos.nombres,
            public.tbl_eqp_estabilizadores.id_patrimonial
            FROM
            public.tbl_eqp_estabilizadores
            INNER JOIN public.tbl_web_personal_areas_equipos ON public.tbl_eqp_estabilizadores.id_estabilizador = public.tbl_web_personal_areas_equipos.id_tabla
            INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_estabilizadores.tipo
            WHERE
            public.tbl_web_personal_areas_equipos.id_personal_area = $id_personal_area AND
            public.tbl_web_personal_areas_equipos.tipo = 3 AND public.a_codigos.numero = 99) AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_patrimonial, marca, modelo, serie");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveEstabilizadoresAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area_equipo", "int");
                $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);
                $personalAreasEquipos = (!$personalAreasEquipos) ? new PersonalAreasEquipos() : $personalAreasEquipos;

                $personalAreasEquipos->id_personal_area = $this->request->getPost("id_personal_area", "int");
                $personalAreasEquipos->tabla = "tbl_eqp_estabilizadores";
                $personalAreasEquipos->id_tabla = $this->request->getPost("id_tabla", "int");
                $personalAreasEquipos->tipo = 3;

                if ($this->request->getPost("conservacion", "int") == "") {
                    $personalAreasEquipos->conservacion = null;
                } else {
                    $personalAreasEquipos->conservacion = $this->request->getPost("conservacion", "int");
                }

                $personalAreasEquipos->ubicacion = $this->request->getPost("ubicacion", "string");
                $personalAreasEquipos->observaciones = $this->request->getPost("observaciones", "string");

                $personalAreasEquipos->usuario = $this->request->getPost("usuario", "string");

                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $personalAreasEquipos->teamviewer = $this->request->getPost("teamviewer", "string");
                $personalAreasEquipos->anydesk = $this->request->getPost("anydesk", "string");
                $personalAreasEquipos->ip = $this->request->getPost("ip", "string");

                $personalAreasEquipos->estado = "A";

                if ($personalAreasEquipos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($personalAreasEquipos->getMessages());
                } else {

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

    public function getAjaxValidarEstabilizadoresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $id_tabla = (int) $this->request->getPost("id_tabla", "int");
            $id_tabla_hidden = (int) $this->request->getPost("id_tabla_hidden", "int");
            $id_personal_area = (int) $this->request->getPost("id_personal_area", "int");

            if ($id_tabla == $id_tabla_hidden) {

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                //$obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_estabilizadores' AND id_personal_area = {$id_personal_area} AND id_tabla = {$id_tabla} AND tipo = 3 AND estado = 'A'");
                $obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_estabilizadores' AND id_tabla = {$id_tabla} AND tipo = 3 AND estado = 'A'");


                if ($obj) {

                    // print("existe");
                    // exit();

                    $db = $this->db;
                    $sql_query = "SELECT
                    public.tbl_web_areas.nombres AS area_nombre,
                    CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre
                    FROM
                    public.tbl_web_personal_areas
                    INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
                    INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_personal_areas.area
                    WHERE
                    public.tbl_web_personal_areas.codigo = $obj->id_personal_area";

                    // print($sql_query);
                    // exit();

                    $sql_query_result = $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

                    // echo"<pre>";
                    // print_r($sql_query_result->area_nombre." - ".$sql_query_result->personal_nombre);
                    // exit();

                    $area = $sql_query_result->area_nombre;
                    $personal = $sql_query_result->personal_nombre;

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe", "area" => $area, "personal" => $personal));
                    $this->response->send();
                } else {

                    // print("no existe");
                    // exit();

                    //$this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxUsuariosEstabilizadoresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $obj = PersonalAreasEquipos::findFirstByid_personal_area_equipo((int) $this->request->getPost("id", "int"));

            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //---------------------------------------------pantallas-----------------------------------------------
    public function datatablePantallasAction($id_personal_area)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal_area_equipo");
            $datatable->setSelect("id_personal_area_equipo,id_pantalla,tipo,marca,modelo,serie,color, estado, id_patrimonial,nombres");
            $datatable->setFrom("(SELECT
            public.tbl_web_personal_areas_equipos.id_personal_area_equipo AS id_personal_area_equipo,
            public.tbl_eqp_pantallas.id_pantalla,
            public.tbl_eqp_pantallas.tipo,
            public.tbl_eqp_pantallas.marca,
            public.tbl_eqp_pantallas.modelo,
            public.tbl_eqp_pantallas.serie,
            public.tbl_eqp_pantallas.color,
            public.tbl_web_personal_areas_equipos.estado AS estado,
            public.a_codigos.nombres,
            public.tbl_eqp_pantallas.id_patrimonial
            FROM
            public.tbl_eqp_pantallas
            INNER JOIN public.tbl_web_personal_areas_equipos ON public.tbl_eqp_pantallas.id_pantalla = public.tbl_web_personal_areas_equipos.id_tabla
            INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_pantallas.tipo
            WHERE
            public.tbl_web_personal_areas_equipos.id_personal_area = $id_personal_area AND
            public.tbl_web_personal_areas_equipos.tipo = 4 AND public.a_codigos.numero = 96) AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_patrimonial, marca, modelo, serie");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function savePantallasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area_equipo", "int");
                $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);
                $personalAreasEquipos = (!$personalAreasEquipos) ? new PersonalAreasEquipos() : $personalAreasEquipos;

                $personalAreasEquipos->id_personal_area = $this->request->getPost("id_personal_area", "int");
                $personalAreasEquipos->tabla = "tbl_eqp_pantallas";
                $personalAreasEquipos->id_tabla = $this->request->getPost("id_tabla", "int");
                $personalAreasEquipos->tipo = 4;

                if ($this->request->getPost("conservacion", "int") == "") {
                    $personalAreasEquipos->conservacion = null;
                } else {
                    $personalAreasEquipos->conservacion = $this->request->getPost("conservacion", "int");
                }

                $personalAreasEquipos->ubicacion = $this->request->getPost("ubicacion", "string");
                $personalAreasEquipos->observaciones = $this->request->getPost("observaciones", "string");

                $personalAreasEquipos->usuario = $this->request->getPost("usuario", "string");


                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $personalAreasEquipos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $personalAreasEquipos->teamviewer = $this->request->getPost("teamviewer", "string");
                $personalAreasEquipos->anydesk = $this->request->getPost("anydesk", "string");
                $personalAreasEquipos->ip = $this->request->getPost("ip", "string");

                $personalAreasEquipos->estado = "A";

                if ($personalAreasEquipos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($personalAreasEquipos->getMessages());
                } else {

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

    public function getAjaxValidarPantallasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $id_tabla = (int) $this->request->getPost("id_tabla", "int");
            $id_tabla_hidden = (int) $this->request->getPost("id_tabla_hidden", "int");
            $id_personal_area = (int) $this->request->getPost("id_personal_area", "int");

            if ($id_tabla == $id_tabla_hidden) {

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                //$obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_pantallas' AND id_personal_area = {$id_personal_area} AND id_tabla = {$id_tabla} AND tipo = 4 AND estado = 'A'");
                $obj = PersonalAreasEquipos::findFirst("tabla = 'tbl_eqp_pantallas' AND id_tabla = {$id_tabla} AND tipo = 4 AND estado = 'A'");


                if ($obj) {

                    //print("existe");
                    //exit();

                    $db = $this->db;
                    $sql_query = "SELECT
                    public.tbl_web_areas.nombres AS area_nombre,
                    CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre
                    FROM
                    public.tbl_web_personal_areas
                    INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
                    INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_personal_areas.area
                    WHERE
                    public.tbl_web_personal_areas.codigo = $obj->id_personal_area";

                    // print($sql_query);
                    // exit();

                    $sql_query_result = $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

                    // echo"<pre>";
                    // print_r($sql_query_result->area_nombre." - ".$sql_query_result->personal_nombre);
                    // exit();

                    $area = $sql_query_result->area_nombre;
                    $personal = $sql_query_result->personal_nombre;

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe", "area" => $area, "personal" => $personal));
                    $this->response->send();
                } else {

                    //print("no existe");
                    //exit();

                    //$this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxUsuariosPantallasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $obj = PersonalAreasEquipos::findFirstByid_personal_area_equipo((int) $this->request->getPost("id", "int"));

            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function datatableRecursosticAction($id_personal_area)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("personal_nombre, usuario, nombre_equipo, tipo_nombre,  marca, modelo, serie, color, teamviewer, anydesk, ip, pae_estado");
            $datatable->setFrom("view_consulta_recursos_tic");
            $datatable->setWhere("id_personal_area =$id_personal_area");
            $datatable->setOrderby("personal_nombre");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function eliminarUsuariosPantallasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            echo '<pre>';
            print_r($_POST);
            exit();

            $id = (int) $this->request->getPost("id", "int");
            $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);

            if ($personalAreasEquipos && $personalAreasEquipos->estado = 'A') {
                $personalAreasEquipos->estado = 'X';
                $personalAreasEquipos->save();
                //$this->db->delete("tbl_seg_usuarios_detalles", "id_usuario_detalle = {$id_usuario_detalle}");
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

    public function eliminarUsuariosEstabilizadoresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            echo '<pre>';
            print_r($_POST);
            exit();

            $id = (int) $this->request->getPost("id", "int");
            $personalAreasEquipos = PersonalAreasEquipos::findFirstByid_personal_area_equipo($id);

            if ($personalAreasEquipos && $personalAreasEquipos->estado = 'A') {
                $personalAreasEquipos->estado = 'X';
                $personalAreasEquipos->save();
                //$this->db->delete("tbl_seg_usuarios_detalles", "id_usuario_detalle = {$id_usuario_detalle}");
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
}
