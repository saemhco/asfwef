<?php

class RegistropublicoaController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registropublicoa.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion para agregar colegiado y editar
    public function registroAction($id = null) {


        $this->view->id = $id;
        if ($id != null) {
            $Postulantes = Postulantes::findFirstBycodigo((int) $id);
        } else {
            $Postulantes = Postulantes::findFirstBycodigo(0);
        }

        $this->view->postulantes = $Postulantes;


        //Modelo documentos(a_codigos)        
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //Modelo seguro(a_codigos)
        $seguro = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguro;

        //Modelo Capitulos (capitulos)
        $capitulo = Capitulos::find("estado = 'A'");
        $this->view->capitulos = $capitulo;

        //Modelo Consejos (consejos)
        $consejo = Consejos::find("estado = 'A'");
        $this->view->consejos = $consejo;

        //Modelo Regiones (regiones)
        $regiones = Regiones::find("estado = 'A'");
        $this->view->regiones = $regiones;

        //Modelo Provincias (provincias)
        $provincias = Provincias::find("estado = 'A'");
        $this->view->provincias = $provincias;

        //Modelo Distritos (distritos)
        $distrito = Distritos::find("estado = 'A'");
        $this->view->distritos = $distrito;

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;


        
        $categoriaPostulante = CategoriaPostulante::find("estado = 'A' AND numero = 104");
        $this->view->categoriapostulante = $categoriaPostulante;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, apellidos_nombres, nro_doc, telefono, celular, direccion, estado, foto, archivo, archivo_escuela, email");
            $datatable->setFrom("(SELECT P
            .codigo AS pk,
            P.codigo,
            CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS apellidos_nombres,
            P.nro_doc,
            P.telefono,
            P.celular,
            P.direccion,
            P.estado,
            P.foto,
            P.archivo,
            P.archivo_escuela,
            P.email 
            FROM
            publico P ) AS temporal_table"); //$datatable->setFrom("colegiados");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("c.estado = 'A'");
            $datatable->setOrderby("codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar colegiado
    public function saveAction() {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        //         echo '<pre>';
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Postulantes = PublicoAspefeenAdmin::findFirstBycodigo($id);
                $Postulantes = (!$Postulantes) ? new PublicoAspefeenAdmin() : $Postulantes;

                $Postulantes->tipo = 0;
                $Postulantes->apellidop = strtoupper($this->request->getPost("apellidop"));
                $Postulantes->apellidom = strtoupper($this->request->getPost("apellidom"));
                $Postulantes->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("documento", "int") == "") {
                    $Postulantes->documento = null;
                } else {
                    $Postulantes->documento = $this->request->getPost("documento", "int");
                }

                $Postulantes->nro_doc = $this->request->getPost("nro_doc", "string");
                $Postulantes->celular = $this->request->getPost("celular", "string");
                $Postulantes->email = $this->request->getPost("email", "string");
                $Postulantes->ciudad = strtoupper($this->request->getPost("ciudad", "string"));

                //$password_postulantes = $this->request->getPost("nro_doc", "string");
                //$Postulantes->password = $this->security->hash($password_postulantes);

                $Postulantes->estado = "A";

                if ($this->request->getPost("tipo_institucion", "int") == "") {
                    $Postulantes->tipo_institucion = null;
                } else {
                    $Postulantes->tipo_institucion = $this->request->getPost("tipo_institucion", "int");
                }
                $Postulantes->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("categoria", "int") == "") {
                    $Postulantes->categoria = null;
                } else {
                    $Postulantes->categoria = $this->request->getPost("categoria", "int");
                }
                $Postulantes->escuela = $this->request->getPost("escuela", "string");

                if ($Postulantes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Postulantes->getMessages());
                } else {


                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
              
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Postulantes->foto)) {
                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . $Postulantes->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.jpg';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $Postulantes->codigo . '.jpg';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . ".jpg";
                                    }

                                    
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                  
                                    }
                                    
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Postulantes->foto)) {
                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . $Postulantes->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.png';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $Postulantes->codigo . '.png';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . ".png";
                                    }

                                    
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                    
                                    }
                                    
                                }

                            }



                         
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Postulantes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.pdf';

                                        $Postulantes->archivo = 'FILE' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE' . '-' . $Postulantes->codigo . '.pdf';

                                        $Postulantes->archivo = 'FILE' . '-' . $Postulantes->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_ruc") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Postulantes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_ruc;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'RUC' . '-' . $Postulantes->nro_ruc . '-' . $temporal_rand . '.pdf';

                                        $Postulantes->archivo_ruc = 'RUC' . '-' . $Postulantes->nro_ruc . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'RUC' . '-' . $Postulantes->nro_ruc . '.pdf';

                                        $Postulantes->archivo_ruc = 'RUC' . '-' . $Postulantes->nro_ruc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_cp") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Postulantes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_cp;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'CP' . '-' . $Postulantes->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $Postulantes->archivo_cp = 'CP' . '-' . $Postulantes->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'CP' . '-' . $Postulantes->nro_doc . '.pdf';

                                        $Postulantes->archivo_cp = 'CP' . '-' . $Postulantes->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }


                            if ($file->getKey() == "archivo_escuela") {

                                if ($_FILES['archivo_escuela']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_escuela']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-CGT' . '-' .$Postulantes->codigo . "." . $extension;
                                       $Postulantes->archivo_escuela = 'FILE-CGT' . '-' .$Postulantes->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_escuela"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Postulantes->save();
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

    //Funcion para eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Postulantes = Postulantes::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Postulantes && $Postulantes->estado = 'A') {
                $Postulantes->estado = 'X';
                $Postulantes->save();
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


    //validar docentes registrado
    public function publicoRegistradoAction() {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Postulantes = Postulantes::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($Postulantes) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
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


    public function restablecerPassAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            // echo "<pre>";
            // print_r($_POST);
            // exit();
            $Usuario = PublicoAspefeenRepass::findFirstBycodigo((int) $this->request->getPost("id_publico", "int"));
            if ($Usuario && $Usuario->estado = 'A') {
                // print($Usuario->nro_doc);
                // exit();
                $nroDoc = $Usuario->nro_doc;
                $Usuario->password = $this->security->hash($nroDoc);
                $Usuario->save();
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
