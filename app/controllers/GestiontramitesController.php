<?php

class GestiontramitesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //index
    public function indexAction() {
        
    }

    //documentos externos
    public function documentosExternosAction() {
        
    }

    //documentos internos
    public function documentosInternosAction() {
        
    }

    //asignacion areas
    public function asignacionAreasAction() {
        //persoanl
        $Personal = Personal::find("estado = 'A' ORDER BY apellidop, apellidom, nombres");
        $this->view->personal = $Personal;

        //area
        $Areas = Areas::find("estado = 'A' ORDER BY nombres");
        $this->view->areas = $Areas;

        //perfil tramite 
        $PerfilTramite = PerfilTramite::find("estado = 'A' AND numero = 88");
        $this->view->perfil_tramite = $PerfilTramite;

        $this->assets->addJs("adminpanel/js/modulos/gestiontramites.asignacionareas.js?v=" . uniqid());
    }

    //datatablesasigacionareas
    public function datatableAsignacionAreasAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, personal, area, perfil, estado");
            $datatable->setFrom("(SELECT
                                    personal_areas.codigo AS codigo,
                                    CONCAT ( personal.apellidop, ' ', personal.apellidom, ' ', personal.nombres ) AS personal,
                                    areas.nombres AS area,
                                    perfil.nombres AS perfil,
                                    personal_areas.estado AS estado
                                    FROM
                                    tbl_doc_personal_areas AS personal_areas 
                                    INNER JOIN 	tbl_web_personal AS personal ON personal.codigo = personal_areas.personal
                                    INNER JOIN 	tbl_web_areas AS areas ON areas.codigo = personal_areas.area
                                    INNER JOIN a_codigos AS perfil ON perfil.codigo = personal_areas.perfil
                                    WHERE perfil.numero = 88) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("personal DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //get nuevo
    public function getNuevoAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $TramitePersonalArea = TramitePersonalArea::count();

//            echo '<pre>';
//            print_r("Codigo Tramite Personal Area:".$TramitePersonalArea);
//            exit();

            if ($TramitePersonalArea >= 0) {
                $codigo = $TramitePersonalArea + 1;
                $this->response->setJsonContent(array("say" => "yes", "codigo" => $codigo));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //saveAsignarAreas
    public function saveAsignacionAreasAction() {

//        echo '<pre>';
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $TramitePersonalArea = TramitePersonalArea::findFirstBycodigo($id);
                $TramitePersonalArea = (!$TramitePersonalArea) ? new TramitePersonalArea() : $TramitePersonalArea;

                $TramitePersonalArea->codigo = $this->request->getPost("codigo", "int");
                $TramitePersonalArea->personal = $this->request->getPost("personal", "int");
                $TramitePersonalArea->area = $this->request->getPost("area", "int");
                $TramitePersonalArea->perfil = $this->request->getPost("perfil", "int");
                $TramitePersonalArea->estado = "A";

                if ($TramitePersonalArea->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($TramitePersonalArea->getMessages());
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

    //editar
    public function editarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $TramitePersonalArea = TramitePersonalArea::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($TramitePersonalArea && $TramitePersonalArea->estado = 'X') {
                $TramitePersonalArea->estado = 'A';
                $TramitePersonalArea->save();
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

    //eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $TramitePersonalArea = TramitePersonalArea::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($TramitePersonalArea && $TramitePersonalArea->estado = 'A') {
                $TramitePersonalArea->estado = 'X';
                $TramitePersonalArea->save();
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
    
       public function getTramitePersonalAreaAction() {

//           echo '<pre>';
//           print_r($_POST);
//           exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {



            $personal = (int) $this->request->getPost("personal", "int");
            $area = (int) $this->request->getPost("area", "int");
            $perfil= (int) $this->request->getPost("perfil", "int");


            $TramitePersonalArea = TramitePersonalArea::findFirst(
                            [
                                "personal = {$personal} AND area = {$area} AND perfil = {$perfil}"
                            ]
            );

//echo '<pre>';
//print_r($TramitePersonalArea->personal);
//exit();

            if ($TramitePersonalArea) {
                
//                print("Personal ya existe");
//                exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
//                 print("Personal no existe");
//                exit();
                
                //$this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
        } else {
            $this->response->setStatusCode(500);
        }
        $this->response->send();
    }




}
