<?php
require_once APP_PATH . '/app/library/pdf.php';
class LibrosprestamosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
        //Llamamos el js en el constructor para utilizzarlos con todas las funciones
        $this->assets->addJs("adminpanel/js/modulos/librosprestamos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Cargamos el datatable
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("pk AS codigo, alumno, docente, publico, lector, tipo, codigo_lector, fecha_entrega, fecha_devolucion, codigos");
            $datatable->setFrom("view_prestamos_confirmados");
            $datatable->setWhere("tipo > 1");
            $datatable->setOrderby("codigos DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function aplicaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_prestamo = (int) $this->request->getPost("id_prestamo", "int");

            $Prestamos = $this->modelsManager->createBuilder()
                    //Instanciamos al modelo "Detallealquiler"
                    ->from('PrestamosDetalles')
                    ->columns('Libros.titulo, LibrosEjemplares.numero')
                    //Se escribe el nombre del Modelo "Libro"
                    ->join('Libros', 'Libros.id_libro = PrestamosDetalles.id_libro')
                    ->join('LibrosEjemplares', 'LibrosEjemplares.id_ejemplar = PrestamosDetalles.id_ejemplar')
                    ->where("PrestamosDetalles.id_prestamo = $id_prestamo ")
                    ->getQuery()
                    ->execute();

            //print_r($Prestamos);exit();
            //enviamos por json la variable de $alquieleres

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("prestamos" => $Prestamos->toArray()));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function devolverAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_prestamo = (int) $this->request->getPost("id_prestamo", "int");
            $Prestamos = Prestamos::findFirst("id_libro_prestamo = $id_prestamo");
            $Prestamos->fecha_devolucion_confirmada = date('Y-m-d');
            $Prestamos->hora_devolucion_confirmada = date('H:i:s');

            $Prestamos->estado = 3;

            $PrestamosDetalles = PrestamosDetalles::find("id_prestamo = $id_prestamo");

            foreach ($PrestamosDetalles as $key => $value) {
                $librosEjemplares = LibrosEjemplares::findFirst("id_libro = $value->id_libro AND id_ejemplar = $value->id_ejemplar");
                $librosEjemplares->activo = 1;
                $librosEjemplares->save();
            }

            $Prestamos->save();
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function registroAction() {

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        //tipo de prestamos
        $tipo_prestamos = TipoPrestamos::find("estado = 'A' AND numero = 54 AND codigo > 1");
        $this->view->tipoprestamos = $tipo_prestamos;
    }

    public function datatablelectoresAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, lector, perfil, estado");
            $datatable->setFrom("view_lectores");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatablelibrosAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("l.id_libro");
            $datatable->setSelect("l.id_libro,
            l.codigo AS codigo,
            l.titulo AS titulo,
            l.fecha_publicacion AS fecha_lanzamiento,
            l.paginas AS paginas,
            e.descripcion AS editorial,
            c.nombres AS categoria,
            i.nombres AS idioma,
            l.cantidad_ejemplares AS cantidad_ejemplares,
            l.codigo_barra AS codigo_barra,
            l.codigo AS codigo,
            l.isbn AS isbn, l.estado,
            libros_ejemplares.id_ejemplar,
            libros_ejemplares.numero,
            autores1.descripcion AS autor1,
            autores2.descripcion AS autor2,
            autores3.descripcion AS autor3");
            $datatable->setFrom("tbl_lib_libros l
            INNER JOIN a_codigos c ON l.categoria = c.codigo
            INNER JOIN tbl_lib_editoriales e ON l.editorial = e.id_editorial
            INNER JOIN a_codigos i ON i.codigo = l.idioma
            INNER JOIN tbl_lib_libros_ejemplares libros_ejemplares ON libros_ejemplares.id_libro = l.id_libro
            LEFT JOIN 	tbl_lib_autores autores1 ON autores1.id_autor = l.autor_1
            LEFT JOIN 	tbl_lib_autores autores2 ON autores1.id_autor = l.autor_2
            LEFT JOIN 	tbl_lib_autores autores3 ON autores1.id_autor = l.autor_3");
            $datatable->setWhere("l.estado = 'A' AND l.cantidad_ejemplares > 0 AND c.numero =48 AND i.numero = 49 AND libros_ejemplares.activo = 1");
            $datatable->setOrderby("l.id_libro ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $libros = $this->request->getPost("libros");
                $Prestamos = new Prestamos();
                $Prestamos->codigos = $this->request->getPost("codigos", "int");
                $tipo_lector = $this->request->getPost("perfil", "int");

                if ($tipo_lector == 3) {
                    $Prestamos->alumno = 1;
                } else {
                    $Prestamos->alumno = 0;
                }

                if ($tipo_lector == 4) {
                    $Prestamos->docente = 1;
                } else {
                    $Prestamos->docente = 0;
                }

                if ($tipo_lector == 5) {
                    $Prestamos->publico = 1;
                } else {
                    $Prestamos->publico = 0;
                }



                $Prestamos->fecha_entrega = date('Y-m-d');
                $Prestamos->hora_reserva = date('H:i:s');


                if ($this->request->getPost("fecha_devolucion", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_devolucion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $Prestamos->fecha_devolucion = date('Y-m-d', strtotime($fecha_new));
                }

                $Prestamos->estado = 2;

                //print($this->request->getPost("tipo", "int"));
                //exit();

                $Prestamos->tipo = $this->request->getPost("tipo", "int");

                if ($Prestamos->save() == false) {

                    //print("No se guarda");
                    //exit();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Prestamos->getMessages());
                } else {

                    //echo "<pre>";
                    //print_r($Prestamos->id_libro_prestamo);
                    //exit();
                    //por ser un array no se pone string
                    $libros = $this->request->getPost("libros");


                    foreach ($libros as $key => $value) {

                        $PrestamosDetalles = new PrestamosDetalles();

                        //echo '<pre>';
                        //print_r($value.'-'.$Prestamos->id_libro_prestamo);

                        $valueExplode = explode('-', $value);
                        $id_libro = $valueExplode[0];
                        $id_ejemplar = $valueExplode[1];

                       //echo '<pre>';
                       //print_r("id_libro: ".$id_libro." - id_ejemplar: ".$id_ejemplar);

                        
                        $PrestamosDetalles->id_libro = $id_libro;
                        $PrestamosDetalles->id_prestamo = $Prestamos->id_libro_prestamo;
                        $PrestamosDetalles->id_ejemplar = $id_ejemplar;
                        $PrestamosDetalles->estado = "A";

                        $librosEjemplares = LibrosEjemplares::findFirst("id_libro = $id_libro AND id_ejemplar = $id_ejemplar");
                        $librosEjemplares->activo = 0;
                        $librosEjemplares->save();

                        $PrestamosDetalles->save();
                        
                    }
                    //exit();
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

            //llega la captura del ajax mediante el parametro getPost

            $codigo = (string) $this->request->getPost("codigo", "string");
            $perfil = (int) $this->request->getPost("perfil", "int");

            //echo '<pre>';
            //print_r("Codigo:" . $codigo . ' - ' . "Perfil:" . $perfil);
            //exit();

            $Lector = Lectores::findFirst(
                            [
                                "codigo = '$codigo' AND perfil = $perfil"
                            ]
            );

            //echo '<pre>';
            //print_r($Lector->nombres);
            //exit();


            if ($Lector) {
                $this->response->setJsonContent($Lector->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
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
        FROM view_prestamos_confirmados WHERE tipo < 1 AND (fecha_entrega BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') Order by pk";

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


    public function librosEjemplaresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            //Libros
            $id_libro = (int) $this->request->getPost("id1", "int");
            $id_ejemplar = (int) $this->request->getPost("id2", "int");

            //Detalle de autores
            //$Detalle_autores = Detalleautores::find("estado = 'A' AND id_libro=" . $Libro->id_libro);
            //$Detalle_autor = Detalleautores::find("id_libro=" . $Libro->codigo);
            //$Detalle_autores->delete();

            $sql = $this->modelsManager->createQuery("SELECT libros.titulo,
            libros.id_libro,
            libros.codigo AS codigo,
            libros.fecha_publicacion AS fecha_lanzamiento,
            libros.paginas AS paginas,
            libros.cantidad_ejemplares AS cantidad_ejemplares,
            libros.isbn AS isbn,
            libros.autor_1 AS autor_1,
            libros.autor_2 AS autor_2,
            libros.autor_3 AS autor_3,
            libros.id_libro AS libro_id,
            autores1.descripcion AS autor1,
            autores2.descripcion AS autor2,
            autores3.descripcion AS autor3 ,
            librosejemplares.numero AS numero,
            librosejemplares.id_ejemplar           
            FROM Libros libros
            LEFT JOIN Autores autores1 ON autores1.id_autor = libros.autor_1
            LEFT JOIN Autores autores2 ON autores2.id_autor = libros.autor_2
            LEFT JOIN Autores autores3 ON autores3.id_autor = libros.autor_3
            INNER JOIN LibrosEjemplares librosejemplares ON librosejemplares.id_libro = libros.id_libro
            WHERE libros.id_libro = $id_libro AND librosejemplares.id_ejemplar = $id_ejemplar");
            $libro = $sql->execute();

            // foreach ($libro as $value) {
            //     echo "<pre>";
            //     print_r($value->titulo);
            // }
            // exit();


            if ($libro) {
                $this->response->setJsonContent($libro->toArray());
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
