<?php

class RegistroprocesosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
        $this->assets->addJs("adminpanel/js/modulos/registroprocesos.js?v=" . uniqid());
    }

    public function admisionAction()
    {

    }
    
    public function procesoAdmisionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $dbDelete = $this->db;
            $sqlDelete = " DELETE FROM alumnos_asignaturas ";
            $dbDelete->fetchOne($sqlDelete, Phalcon\Db::FETCH_OBJ);
    
            //alumnos_asignaturas
            $publicoModel = Publico::find();
            foreach ($publicoModel as $publico) {
                $AlumnosAsignaturas = new AlumnosAsignaturas();
                $AlumnosAsignaturas->semestre = 1;
                $AlumnosAsignaturas->asignatura = 1;
                $AlumnosAsignaturas->grupo = 1;
                $AlumnosAsignaturas->alumno = $publico->codigo;
                $AlumnosAsignaturas->veces = 1;
                $AlumnosAsignaturas->tipo = 1;
                $AlumnosAsignaturas->estado = 'A';
                $AlumnosAsignaturas->save();
            }
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

}
