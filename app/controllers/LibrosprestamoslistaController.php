<?php
require_once APP_PATH . '/app/library/pdf.php';
class LibrosprestamoslistaController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/librosprestamoslista.js?v=" . uniqid());
    }

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("pk, alumno, docente, publico, lector, codigo_lector, fecha_entrega, fecha_devolucion_confirmada,hora_devolucion_confirmada, prestamo");
            $datatable->setFrom("view_prestamos_lista");
            $datatable->setWhere("tipo > 1");
            $datatable->setOrderby("prestamo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //ver libro
    public function verAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_prestamo = (int) $this->request->getPost("id_prestamo", "int");

            $PrestamosDetalles = $this->modelsManager->createBuilder()
                    //Instanciamos al modelo "Detallealquiler"
                    ->from('PrestamosDetalles')
                    ->columns('Libros.titulo, LibrosEjemplares.numero')
                    //Se escribe el nombre del Modelo "Libro"
                    ->join('Libros', 'Libros.id_libro = PrestamosDetalles.id_libro')
                    ->join('LibrosEjemplares', 'LibrosEjemplares.id_ejemplar = PrestamosDetalles.id_ejemplar')
                    ->where("PrestamosDetalles.id_prestamo =" . $id_prestamo . "")
                    ->getQuery()
                    ->execute();

            //print_r($alquileres);exit();
            //enviamos por json la variable de $alquieleres

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("prestamos" => $PrestamosDetalles->toArray()));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }



    /* ------ Excel --------- */
    public function exportarAction($fecha_inicio = null, $fecha_fin = null) {
        $this->view->disable();

        //print($id_personal);
        //exit();
       
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=actividades.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
       
    
        //print($id_personal);
        //exit();


        //sql
        $db = $this->db;
        $sqlQuery = "SELECT codigo_lector, lector, fecha_entrega, fecha_devolucion,alumno,docente,publico 
        FROM view_prestamos_lista WHERE tipo < 1 AND (fecha_entrega BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') Order by pk";

        //print($sql_actividades);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);



        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>LECTOR</td>";
        $test .= "<td>FECHA PRESTAMO</td>";
        $test .= "<td>FECHA DEVOLUCION</td>";
        //$test .= "<td>Archivo</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {
            if($value->alumno=='1'){
                $tipo='ALUMNO';
            }
            if($value->docente=='1'){
                $tipo='DOCENTE';
            }
            if($value->publico=='1'){
                $tipo='PÚBLICO';
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->lector) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_entrega) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_devolucion) . "</td>";
            //$test .= "<td>" . utf8_decode($value->archivo) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        exit();
    }

}
