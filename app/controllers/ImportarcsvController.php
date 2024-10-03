<?php
require_once APP_PATH . '/app/library/pdf.php';
class ImportarcsvController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/importarcsv.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_autor", "int");
                $Autor = Autores::findFirstByid_autor($id);
                $Autor = (!$Autor) ? new Autores() : $Autor;
                $Autor->descripcion = $this->request->getPost("descripcion", "string");
                $Autor->nacionalidad = $this->request->getPost("nacionalidad", "string");
                $Autor->estado = "A";


                if ($Autor->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Autor->getMessages());
                } else {
                    //Cuando va bien 
                    
                    //obtenemos el ultimo id_autor para insertar en el select de registro de libros/registro
                    $id_autor_nuevo = Autores::count();
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes","id_autor_nuevo" => $id_autor_nuevo));
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




    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_autor");
            $datatable->setSelect("id_autor,"
                    . " descripcion, nacionalidad,"
                    . " estado");
            $datatable->setFrom("tbl_lib_autores");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("descripcion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
