<?php

class RegistrolibrosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
        $this->assets->addJs("adminpanel/js/modulos/registrolibros.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    //Funcion agregar libro y editar
    public function registroAction($id = null)
    {
        $this->view->id = $id;
        //
        if ($id != null) {
            $Libros = Libros::findFirstByid_libro((int) $id);
        } else {
            $Libros = Libros::findFirstByid_libro(0);
        }

        $this->view->libros = $Libros;
        //

        $categorias = Categorias::find("estado = 'A' AND numero = 48");
        $this->view->categorias = $categorias;

        $editoriales = Editoriales::find("estado = 'A' ORDER BY descripcion");
        $this->view->editoriales = $editoriales;

        $idiomas = Idiomas::find("estado = 'A' AND numero = 49");
        $this->view->idiomas = $idiomas;

        $programas = Programas::find("estado = 'A'");
        $this->view->programas = $programas;

        $tipomaterialbibliograficos = TipoMaterialBibliografico::find("estado = 'A' AND numero = 43");
        $this->view->tipomaterialbibliograficos = $tipomaterialbibliograficos;

        //Autores
        $autor_uno = Autores::find("estado = 'A' ORDER BY descripcion");
        $this->view->autor_uno = $autor_uno;

        $autor_dos = Autores::find("estado = 'A' ORDER BY descripcion");
        $this->view->autor_dos = $autor_dos;

        $autor_tres = Autores::find("estado = 'A' ORDER BY descripcion");
        $this->view->autor_tres = $autor_tres;
        
        $db = $this->db;
        $sqlLibrosPedidos = "SELECT
        public.tbl_lib_adquisiciones.id_adquisicion,
        to_char(public.tbl_lib_adquisiciones.fecha_adquisicion, 'DD/MM/YYYY') AS fecha_adquisicion,
        public.tbl_lib_adquisiciones.numero_oc,
        public.tbl_lib_adquisiciones.descripcion
        FROM
        public.tbl_lib_adquisiciones
        WHERE
        public.tbl_lib_adquisiciones.estado = 'A'";
        $librosPedidos = $db->fetchAll($sqlLibrosPedidos, Phalcon\Db::FETCH_OBJ);
        $this->view->librospedidos = $librosPedidos;



        $this->assets->addJs("adminpanel/js/modulos/registrolibros.ejemplares.js?v=" . uniqid());
    }

    public function saveAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        //         echo "<pre>";
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_libro", "int");
                $Libros = Libros::findFirstByid_libro($id);
                //$Libros = (!$Libros) ? new Libros() : $Libros;

                if ($Libros) {
                    $Libros->fecha_mod = date("Y-m-d H:i:s");
                } else {
                    $Libros = new Libros();
                    $Libros->fecha_reg = date("Y-m-d H:i:s");
                }

                //titulo
                $Libros->titulo = $this->request->getPost("titulo", "string");

                if ($this->request->getPost("autor_1", "int") == "") {
                    $Libros->autor_1 = null;
                } else {
                    $Libros->autor_1 =$this->request->getPost("autor_1", "int");
                }

                if ($this->request->getPost("autor_2", "int") == "") {
                    $Libros->autor_2 = null;
                } else {
                    $Libros->autor_2 =$this->request->getPost("autor_2", "int");
                }
                
                if ($this->request->getPost("autor_3", "int") == "") {
                    $Libros->autor_3 = null;
                } else {
                    $Libros->autor_3 =$this->request->getPost("autor_3", "int");
                }

                if ($this->request->getPost("editorial", "int") == "") {
                    $Libros->editorial = null;
                } else {
                    $Libros->editorial = $this->request->getPost("editorial", "int");
                }

                if ($this->request->getPost("tipo_material_bibliografico", "int") == "") {
                    $Libros->tipo_material_bibliografico = null;
                } else {
                    $Libros->tipo_material_bibliografico = $this->request->getPost("tipo_material_bibliografico", "int");
                }

                //categoria libro
                if ($this->request->getPost("categoria", "int") == "") {
                    $Libros->categoria = null;
                } else {
                    $Libros->categoria = $this->request->getPost("categoria", "int");
                }

                //Idioma
                if ($this->request->getPost("idioma", "int") == "") {
                    $Libros->idioma = null;
                } else {
                    $Libros->idioma = $this->request->getPost("idioma", "int");
                }

                if ($this->request->getPost("fecha_publicacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_publicacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Libros->fecha_publicacion = date('Y-m-d', strtotime($fecha_new));
                }

                //Cantidad de ejemplares
                $Libros->cantidad_ejemplares = $this->request->getPost("cantidad_ejemplares", "int");

                //Tipo de libro
                if ($this->request->getPost("tipocodigo", "int") == "") {
                    $Libros->tipocodigo = null;
                } else {
                    $Libros->tipocodigo = $this->request->getPost("tipocodigo", "int");
                }

                //Codigo de barra
                $Libros->codigo_barra = $this->request->getPost("codigo_barra", "string");

                //Codigo de libros
                $Libros->codigo = $this->request->getPost("codigo", "string");

                //Isbn
                $Libros->isbn = $this->request->getPost("isbn", "int");

                //Año de publicacion
                $Libros->anio_publicacion = $this->request->getPost("anio_publicacion", "int");

                //N# de paginas
                $Libros->paginas = $this->request->getPost("paginas", "string");

                //Lugar de Publicacion
                $Libros->lugar_publicacion = $this->request->getPost("lugar_publicacion", "string");

                //Edicion
                $Libros->edicion = $this->request->getPost("edicion", "string");

                //Edicion
                $Libros->ubicacion = $this->request->getPost("ubicacion", "string");

                $programa_1 = $this->request->getPost("programa_1", "string");
                if (isset($programa_1)) {
                    $Libros->programa_1 = 1;
                } else {
                    $Libros->programa_1 = 0;
                }

                $programa_2 = $this->request->getPost("programa_2", "string");
                if (isset($programa_2)) {
                    $Libros->programa_2 = 1;
                } else {
                    $Libros->programa_2 = 0;
                }

                $programa_3 = $this->request->getPost("programa_3", "string");
                if (isset($programa_3)) {
                    $Libros->programa_3 = 1;
                } else {
                    $Libros->programa_3 = 0;
                }

                $programa_4 = $this->request->getPost("programa_4", "string");
                if (isset($programa_4)) {
                    $Libros->programa_4 = 1;
                } else {
                    $Libros->programa_4 = 0;
                }

                $programa_5 = $this->request->getPost("programa_5", "string");
                if (isset($programa_5)) {
                    $Libros->programa_5 = 1;
                } else {
                    $Libros->programa_5 = 0;
                }

                $programa_6 = $this->request->getPost("programa_6", "string");
                if (isset($programa_6)) {
                    $Libros->programa_6 = 1;
                } else {
                    $Libros->programa_6 = 0;
                }

                $Libros->estado = "A";

                $Libros->resumen = $this->request->getPost("resumen", "string");

                if ($this->request->getPost("origen", "int") == "") {
                    $Libros->origen = null;
                } else {
                    $Libros->origen = $this->request->getPost("origen", "int");
                }

                if ($Libros->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Libros->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_libro") {
                                if ($_FILES['imagen_libro']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_libro']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {
                                        if (isset($Libros->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/libros/' . $Libros->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/libros/' . 'IMG' . '-' . $Libros->id_libro . '-' . $temporal_rand . "." . $extension;
                                            $Libros->imagen = 'IMG' . '-' . $Libros->id_libro . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/libros/' . 'IMG' . '-' . $Libros->id_libro . '.' . $extension;
                                            $Libros->imagen = 'IMG' . '-' . $Libros->id_libro . '.' . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_libro") {

                                if ($_FILES['archivo_libro']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_libro']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Libros->archivo)) {
                                            $url_destino = 'adminpanel/archivos/libros/' . $Libros->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/libros/' . 'FILE' . '-' . $Libros->id_libro . '-' . $temporal_rand . "." . $extension;
                                            $Libros->archivo = 'FILE' . '-' . $Libros->id_libro . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/libros/' . 'FILE' . '-' . $Libros->id_libro . "." . $extension;
                                            $Libros->archivo = 'FILE' . '-' . $Libros->id_libro . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Libros->save();
                    }

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

    public function getAjaxAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo "<pre>";
            //print_r($_POST);
            //exit();

            //Libros
            $Libro = Libros::findFirstByid_libro((int) $this->request->getPost("id_libro", "int"));

            //Detalle de autores
            //$Detalle_autores = Detalleautores::find("estado = 'A' AND id_libro=" . $Libro->id_libro);
            //$Detalle_autor = Detalleautores::find("id_libro=" . $Libro->codigo);
            //$Detalle_autores->delete();

            if ($Libro) {

                //$datos = array("libro" => $Libro->toArray(), "detalle" => $Detalle_autores->toArray());
                $datos = array("libro" => $Libro->toArray());
                //$datos = array("detalle" => $Detalle_autores->toArray());

                $this->response->setJsonContent($datos);
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Libro = Libros::findFirstByid_libro((int) $this->request->getPost("id_libro", "int"));
            if ($Libro && $Libro->estado = 'A') {
                $Libro->estado = 'X';
                $Libro->save();
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

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_libro");
            $datatable->setSelect("id_libro,titulo,autores,isbn,cantidad_ejemplares,estado,codigo,ubicacion");
            $datatable->setFrom("(SELECT
            public.tbl_lib_libros.id_libro,
            public.tbl_lib_libros.titulo,
            CONCAT (autor1.descripcion, '/', autor2.descripcion, '/', autor3.descripcion) AS autores,
            public.tbl_lib_libros.isbn,
            public.tbl_lib_libros.cantidad_ejemplares,
            public.tbl_lib_libros.estado,
            public.tbl_lib_libros.ubicacion,
            public.tbl_lib_libros.codigo
            FROM
            public.tbl_lib_libros
            LEFT JOIN public.tbl_lib_autores AS autor1 ON public.tbl_lib_libros.autor_1 = autor1.id_autor
            LEFT JOIN public.tbl_lib_autores AS autor2 ON public.tbl_lib_libros.autor_2 = autor2.id_autor
            LEFT JOIN public.tbl_lib_autores AS autor3 ON public.tbl_lib_libros.autor_3 = autor3.id_autor) AS temporal_table");
            $datatable->setOrderby("id_libro ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatableEjemplaresAction($idlibro)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_ejemplar");
            $datatable->setSelect("numero,observaciones,adquisicion,id_libro,activo,estado,precio");
            $datatable->setFrom("(SELECT
            public.tbl_lib_libros_ejemplares.id_ejemplar AS id_ejemplar,
            public.tbl_lib_libros_ejemplares.numero AS numero,
            public.tbl_lib_libros_ejemplares.precio AS precio,
            public.tbl_lib_libros_ejemplares.observaciones AS observaciones,
            public.tbl_lib_adquisiciones.descripcion AS adquisicion,
            public.tbl_lib_libros_ejemplares.id_libro AS id_libro,
            public.tbl_lib_libros_ejemplares.activo,
            public.tbl_lib_libros_ejemplares.estado AS estado
            FROM
            public.tbl_lib_adquisiciones
            INNER JOIN public.tbl_lib_libros_ejemplares ON public.tbl_lib_adquisiciones.id_adquisicion = public.tbl_lib_libros_ejemplares.id_adquisicion
            WHERE
            public.tbl_lib_adquisiciones.estado = 'A') AS temporal_table");
            $datatable->setWhere("id_libro = $idlibro");
            $datatable->setOrderby("id_ejemplar ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveEjemplaresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {



            $id_libro = $this->request->getPost("id_libro", "int");
            //$id_ejemplar= $this->request->getPost("id_ejemplar", "int");



            $id_libro = $this->request->getPost("id_libro", "int");
            $libro = Libros::findFirstByid_libro($id_libro);
            $ejemplar = $libro->cantidad_ejemplares;

            for ($i = 1; $i <= $ejemplar; $i++) {

                $verifica = LibrosEjemplares::find("id_libro = $id_libro AND numero = $i");

                if (count($verifica) == 0) {
                    $librosEjemplares = new LibrosEjemplares();
                    $librosEjemplares->id_libro = $libro->id_libro;
                    $librosEjemplares->numero = $i;
                    $librosEjemplares->estado = "A";
                    $librosEjemplares->id_adquisicion = 1;
                    $librosEjemplares->activo = 1;
                    $librosEjemplares->save();
                }
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function eliminarEjemplarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $librosEjemplares = LibrosEjemplares::findFirstByid_ejemplar((int) $this->request->getPost("id", "int"));
            if ($librosEjemplares && $librosEjemplares->estado = 'A') {
                $librosEjemplares->estado = 'X';
                $librosEjemplares->save();
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


    public function editarEjemplarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = LibrosEjemplares::findFirstByid_ejemplar((int) $this->request->getPost("id", "int"));
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

    public function saveEditarEjemplaresAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


            // echo "<pre>";
            // print_r($_POST);
            // exit();

                $id = (int) $this->request->getPost("id_ejemplar", "int");
                $librosEjemplares = LibrosEjemplares::findFirstByid_ejemplar($id);
                $librosEjemplares = (!$librosEjemplares) ? new LibrosEjemplares() : $librosEjemplares;

                $librosEjemplares->id_libro = $this->request->getPost("id_libro", "int");
                $librosEjemplares->id_adquisicion = $this->request->getPost("id_adquisicion", "int");
                $librosEjemplares->observaciones = $this->request->getPost("observaciones", "string");
                $librosEjemplares->precio = $this->request->getPost("precio", "string");
                $activo = $this->request->getPost("activo", "string");

                if (isset($activo)) {
                    $librosEjemplares->activo = 1;
                } else {
                    $librosEjemplares->activo = 0;
                }
                $librosEjemplares->estado = "A";

                if ($librosEjemplares->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($librosEjemplares->getMessages());
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


    public function saveEjemplaresGenralAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $libros = Libros::find();

            foreach ($libros as $libroValue) {

                $libro = Libros::findFirstByid_libro($libroValue->id_libro);
                $ejemplar = $libro->cantidad_ejemplares;

                for ($i = 1; $i <= $ejemplar; $i++) {
                    $verifica = LibrosEjemplares::find("id_libro = $libro->id_libro AND numero = $i");
                    if (count($verifica) == 0) {
                        $librosEjemplares = new LibrosEjemplares();
                        $librosEjemplares->id_libro = $libro->id_libro;
                        $librosEjemplares->numero = $i;
                        $librosEjemplares->estado = "A";
                        $librosEjemplares->id_adquisicion = 1;
                        $librosEjemplares->activo = 1;
                        $librosEjemplares->save();
                    }
                }
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }
}
