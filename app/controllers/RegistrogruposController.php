<?php

class RegistrogruposController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrogrupos.js?v=" . uniqid() . "");
    }

    //index
    public function indexAction() {

        //tipo de usuarios
        $TipoUsuario = TipoUsuario::find("codigo > 0 AND numero = 50 AND estado = 'A'");
//        foreach ($TipoUsuario as $value) {
//            echo '<pre>';
//            print($value->nombres);
//        }
//        exit();
        $this->view->tipo_usuario = $TipoUsuario;
    }

    //
    public function registroAction($id = null, $id_tipo_usuario = null) {


        if ($id != null) {
            $Grupos = Grupos::findFirstByid_grupo((int) $id);
            $this->view->id_grupo = $id;
            $this->view->id_tipo_usuario = $id_tipo_usuario;
            //print("@KenMack");
            //exit();
        } else {
            $Grupos = Grupos::findFirstByid_grupo(0);


            $this->view->id_grupo = 0;
            $this->view->id_tipo_usuario = 0;
        }

        $this->view->grupos = $Grupos;

        //personal
        $Pesonal = Personal::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->personal = $Pesonal;

        $Docentes = Docentes::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->docente = $Docentes;

        $Publico = Publico::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->publico = $Publico;


        $TipoUsuario = TipoUsuario::find("codigo > 0 AND numero = 50 AND estado = 'A'");
//        foreach ($TipoUsuario as $value) {
//            echo '<pre>';
//            print($value->nombres);
//        }
//        exit();
        $this->view->tipo_usuario = $TipoUsuario;

        $this->assets->addJs("adminpanel/js/modulos/grupos.detalles.js?v=" . uniqid());
    }

    //Funcion para guardar obra
    public function saveAction() {

//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $id_grupo = (int) $this->request->getPost("id_grupo", "int");
                $Grupos = Grupos::findFirstByid_grupo($id_grupo);
                $Grupos = (!$Grupos) ? new Grupos() : $Grupos;
                $Grupos->tipo = $this->request->getPost("tipo", "int");
                $Grupos->nombre = $this->request->getPost("nombre", "string");
                $Grupos->estado = "A";


                if ($Grupos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Grupos->getMessages());
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

    //datatable
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            //$auth = $this->session->get('auth');
            //$id_personal = $auth["codigo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_web_grupos.id_grupo");
            $datatable->setSelect("public.tbl_web_grupos.id_grupo,"
                    . "public.tbl_web_grupos.tipo,"
                    . "public.tbl_web_grupos.nombre,"
                    . "public.tbl_web_grupos.estado,"
                    . "public.a_codigos.nombres AS tipo_usuario_nombre");
            $datatable->setFrom("public.tbl_web_grupos INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_web_grupos.tipo");
            $datatable->setWhere("public.a_codigos.numero = 50");
            $datatable->setOrderby("public.tbl_web_grupos.nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Grupos = Grupos::findFirstByid_grupo((int) $this->request->getPost("id_grupo", "int"));
            if ($Grupos) {
                $this->response->setJsonContent($Grupos->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //delete
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Grupos = Grupos::findFirstByid_grupo((int) $this->request->getPost("id_grupo", "int"));
            if ($Grupos && $Grupos->estado = 'A') {
                $Grupos->estado = 'X';
                $Grupos->save();
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

    //datatable actividades_detalles
    public function datatableGruposDetallesAction($id, $id_tipo_usuario) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            //print("Tipo de Usuario: " . $id_tipo_usuario);
            //exit();
            if ($id_tipo_usuario == 2) {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("id_personal_grupo");
                $datatable->setSelect("id_personal_grupo, personal, grupo, estado, nombre_personal, tipo, nombre_grupo");
                $datatable->setFrom("(SELECT
                                    public.tbl_web_personal_grupos.id_personal_grupo AS id_personal_grupo,
                                    public.tbl_web_personal_grupos.personal AS personal,
                                    public.tbl_web_personal_grupos.grupo AS grupo,
                                    public.tbl_web_personal_grupos.estado AS estado,
                                    CONCAT (public.docentes.apellidop, ' ', public.docentes.apellidom, ' ', public.docentes.nombres ) AS nombre_personal,
                                    public.tbl_web_grupos.tipo AS tipo,
                                    public.tbl_web_grupos.nombre AS nombre_grupo
                                    FROM
                                    public.tbl_web_personal_grupos
                                    INNER JOIN public.docentes ON public.docentes.codigo = public.tbl_web_personal_grupos.personal
                                    INNER JOIN public.tbl_web_grupos ON public.tbl_web_grupos.id_grupo = public.tbl_web_personal_grupos.grupo
                                    ) AS temporal_table");
                //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
                $datatable->setWhere("grupo = $id AND tipo = {$id_tipo_usuario}");
                $datatable->setOrderby("nombre_personal");
                $datatable->setParams($_POST);
                $datatable->getJson();
            } else if ($id_tipo_usuario == 3) {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("id_personal_grupo");
                $datatable->setSelect("id_personal_grupo, personal, grupo, estado, nombre_personal, tipo, nombre_grupo");
                $datatable->setFrom("(SELECT
                                    public.tbl_web_personal_grupos.id_personal_grupo AS id_personal_grupo,
                                    public.tbl_web_personal_grupos.personal AS personal,
                                    public.tbl_web_personal_grupos.grupo AS grupo,
                                    public.tbl_web_personal_grupos.estado AS estado,
                                    CONCAT (public.tbl_web_personal .apellidop, ' ', public.tbl_web_personal .apellidom, ' ', public.tbl_web_personal .nombres ) AS nombre_personal,
                                    public.tbl_web_grupos.tipo AS tipo,
                                    public.tbl_web_grupos.nombre AS nombre_grupo
                                    FROM
                                    public.tbl_web_personal_grupos
                                    INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_grupos.personal
                                    INNER JOIN public.tbl_web_grupos ON public.tbl_web_grupos.id_grupo = public.tbl_web_personal_grupos.grupo
                                    ) AS temporal_table");
                //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
                $datatable->setWhere("grupo = $id AND tipo = {$id_tipo_usuario}");
                $datatable->setOrderby("nombre_personal");
                $datatable->setParams($_POST);
                $datatable->getJson();
            } else if ($id_tipo_usuario == 4) {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("id_personal_grupo");
                $datatable->setSelect("id_personal_grupo, personal, grupo, estado, nombre_personal, tipo, nombre_grupo");
                $datatable->setFrom("(SELECT
                                    public.tbl_web_personal_grupos.id_personal_grupo AS id_personal_grupo,
                                    public.tbl_web_personal_grupos.personal AS personal,
                                    public.tbl_web_personal_grupos.grupo AS grupo,
                                    public.tbl_web_personal_grupos.estado AS estado,
                                    CONCAT (public.publico.apellidop, ' ', public.publico.apellidom, ' ', public.publico.nombres ) AS nombre_personal,
                                    public.tbl_web_grupos.tipo AS tipo,
                                    public.tbl_web_grupos.nombre AS nombre_grupo
                                    FROM
                                    public.tbl_web_personal_grupos
                                    INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_personal_grupos.personal
                                    INNER JOIN public.tbl_web_grupos ON public.tbl_web_grupos.id_grupo = public.tbl_web_personal_grupos.grupo
                                    ) AS temporal_table");
                //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
                $datatable->setWhere("grupo = $id AND tipo = {$id_tipo_usuario}");
                $datatable->setOrderby("nombre_personal");
                $datatable->setParams($_POST);
                $datatable->getJson();
            }
        }
    }

    //
    public function saveGruposDetallesAction() {


//        $info = new SplFileInfo('foo.txt');
//        echo "<pre>";
//        print_r(var_dump($info->getExtension()));
//        exit();
//        
//        
//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_grupo", "int");
                $PersonalGrupos = PersonalGrupos::findFirstByid_personal_grupo($id);
                $PersonalGrupos = (!$PersonalGrupos) ? new PersonalGrupos() : $PersonalGrupos;

                $PersonalGrupos->personal = $this->request->getPost("personal", "int");
                $PersonalGrupos->grupo = $this->request->getPost("grupo", "int");
                $PersonalGrupos->estado = "A";


                if ($PersonalGrupos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonalGrupos->getMessages());
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

    //edit
    public function getAjaxGruposDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalGrupos::findFirstByid_personal_grupo((int) $this->request->getPost("id_personal_grupo", "int"));
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

    //delete
    public function eliminarGruposDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$obj = PersonalGrupos::findFirstByid_personal_grupo((int) $this->request->getPost("id_personal_grupo", "int"));
            $id_personal_grupo = (int) $this->request->getPost("id_personal_grupo", "int");
            $obj = PersonalGrupos::findFirstByid_personal_grupo($id_personal_grupo);

            if ($obj && $obj->estado = 'A') {
                //$obj->estado = 'X';
                //$obj->save();
                $this->db->delete("tbl_web_personal_grupos", "id_personal_grupo = {$id_personal_grupo}");
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

    public function getAjaxValidarUsuarioAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));
            //echo '<pre>';
            //print_r($_POST);
            //exit();

            $personal = (int) $this->request->getPost("personal", "int");
            $personal_oculto = (int) $this->request->getPost("personal_oculto", "int");
            $grupo = (int) $this->request->getPost("grupo", "int");


            if ($personal == $personal_oculto) {
                //print("editar");
                //exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $obj = PersonalGrupos::findFirst("grupo = {$grupo} AND personal = {$personal}");
                if ($obj) {
                    //print("update:".$obj->update);
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe"));
                    $this->response->send();
                } else {
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

}
