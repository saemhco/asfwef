<?php

class LibrosprestamoslistawebController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/librosprestamoslistaweb.js?v=" . uniqid());
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("pk, alumno, docente, publico, lector, codigo_lector, fecha_reserva, fecha_entrega, fecha_devolucion_confirmada, prestamo");
            $datatable->setFrom("view_prestamos_lista");
            $datatable->setWhere("tipo = 1");
            $datatable->setOrderby("prestamo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function verAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_prestamo = (int) $this->request->getPost("id_prestamo", "int");

            $prestamosDetalles = $this->modelsManager->createBuilder()
                ->from('PrestamosDetalles')
                ->columns('Libros.titulo, LibrosEjemplares.numero')
                ->join('Libros', 'Libros.id_libro = PrestamosDetalles.id_libro')
                ->join('LibrosEjemplares', 'LibrosEjemplares.id_ejemplar = PrestamosDetalles.id_ejemplar')
                ->where("PrestamosDetalles.id_prestamo = $id_prestamo ")
                ->getQuery()
                ->execute();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("prestamos" => $prestamosDetalles->toArray()));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }
}
