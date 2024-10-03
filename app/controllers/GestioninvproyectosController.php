<?php

class GestioninvproyectosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('Mantenimiento de Proyectos');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestioninvproyectos.js?v=" . uniqid());
    }

    public function indexAction()
    {
        $db = $this->db;
        $procesoModel = "SELECT*FROM public.a_codigos WHERE public.a_codigos.numero = 81 AND codigo <> 100";
        $proceso = $db->fetchAll($procesoModel, Phalcon\Db::FETCH_OBJ);
        $this->view->proceso = $proceso;
    }

    //datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_proyecto");
            $datatable->setSelect("id_proyecto,titulo,fecha_inicio,fecha_termino,entidad_cooperante,estado");
            $datatable->setFrom("tbl_inv_proyectos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_proyecto ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveSeguimientoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_proyecto", "int");
                $Proyectos = Proyectos::findFirstByid_proyecto($id);
                $Proyectos = (!$Proyectos) ? new Proyectos() : $Proyectos;

                if ($this->request->getPost("proceso", "int") == "") {
                    $Proyectos->proceso = null;
                } else {
                    $Proyectos->proceso = $this->request->getPost("proceso", "int");
                }
                $Proyectos->avance = $this->request->getPost("avance", "string");

                $Proyectos->estado = "A";

                if ($Proyectos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Proyectos->getMessages());
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Proyectos = Proyectos::findFirstByid_proyecto((int) $this->request->getPost("id", "int"));
            if ($Proyectos) {
                $this->response->setJsonContent($Proyectos->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

}
