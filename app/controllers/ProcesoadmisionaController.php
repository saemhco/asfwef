<?php

class ProcesoadmisionaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction($id = null)
    {

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $admision_m = Admision::findFirst("activo = 'M'");
        $verifica = AdmisionPostulantes::find("postulante = {$Postulante->codigo} AND admision = $admision_m->codigo");


        if (count($verifica) >= 1) {
        } else {
            return $this->response->redirect("procesoadmisiona/noapto");
        }

        $db = $this->db;
        $sql = "SELECT
        public.admision_supervisores.link_simulacro,
        public.admision_supervisores.link_examen,
        public.admision_supervisores.link_plataforma_lms,
        public.admision_postulantes.password,
        public.admision_postulantes.grupo
        FROM
        public.admision_postulantes
        INNER JOIN public.admision_supervisores ON public.admision_supervisores.id_supervisor = public.admision_postulantes.supervisor AND public.admision_supervisores.grupo = public.admision_postulantes.grupo
        WHERE
        public.admision_postulantes.postulante = $Postulante->codigo AND public.admision_postulantes.admision = $admision_m->codigo";

        print($sql);
        exit();

        $links = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->links = $links;

        $Postulante = Publico::findFirstBycodigo($Postulante->codigo);
        $this->view->postulante = $Postulante;

        // print($Postulante->codigo);
        // exit();

        $categoriaPostulante = CategoriaPostulante::find("estado = 'A' AND numero = 104");
        $this->view->categoriapostulante = $categoriaPostulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $semestres = Semestres::findFirst("activo = 'M'");
        // print($semestres->definicion);
        // exit();
        $this->view->semestre_admision = $semestres;

        //admision m
        $admision_m = Admision::findFirst("activo = 'M'");

        // print("Codigo admision: ".$admision_m->codigo);
        // exit();

        $this->view->admision_m = $admision_m;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //tipo
        $tipo = TipoExamen::find("estado = 'A' AND numero = 22");
        $this->view->tipo = $tipo;

        //concepto
        $concepto = Conceptos::find();
        $this->view->conceptos = $concepto;

        //concepto
        $carreras = Carreras::find("estado = 'A' AND codigo <> '0001'");
        $this->view->carreras = $carreras;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $admision = AdmisionPostulantesa::findFirst(
            [
                "postulante = $Postulante->codigo AND admision = $admision_m->codigo",
            ]
        );
        $this->view->admision = $admision;



        $this->assets->addJs("adminpanel/js/modulos/procesoadmisiona.js?v=" . uniqid());
    }

    public function inscripcionfinAction($id = null)
    {

        if ($id != null) {
            $Postulante = Publico::findFirstBycodigo((int) $id);
            $this->view->id = $id;
        } else {
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        }

        $codigo_postulante = strlen($Postulante->codigo);

        if ($codigo_postulante == 1) {

            $new_codigo = '00000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 2) {
            $new_codigo = '0000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 3) {
            $new_codigo = '000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 4) {
            $new_codigo = '00' . $Postulante->codigo;
        } elseif ($codigo_postulante == 5) {
            $new_codigo = '0' . $Postulante->codigo;
        }

        $this->view->codigo_postulante = $new_codigo;
        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        //$semestres = Semestres::findFirst("activo = 'M'");
        $admision_activo = Admision::findFirst("activo = 'M'");
        $this->view->admision_activo = $admision_activo;

        $postulante = $Postulante->codigo;
        $admision_m = $admision_activo->codigo;

        $admision = AdmisionPostulantesa::findFirst(
            [
                "postulante = $postulante AND admision = $admision_m",
            ]
        );
        $this->view->admision = $admision;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $this->assets->addJs("adminpanel/js/modulos/procesoadmisiona.js?v=" . uniqid());
    }

    public function saveInscripcionAction()
    {

        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $postulante = (int) $this->request->getPost("postulante", "int");
                $admision = (int) $this->request->getPost("admision", "int");

                //$Personal = Personal::findFirstByid_personal($id);
                $AdmisionPostulantes = AdmisionPostulantesa::findFirst(
                    [
                        "postulante = $postulante AND admision = $admision",
                    ]
                );
                //Valida cuando es nuevo

                $AdmisionPostulantes = (!$AdmisionPostulantes) ? new AdmisionPostulantesa() : $AdmisionPostulantes;

                $AdmisionPostulantes->postulante = $this->request->getPost("postulante", "int");
                $AdmisionPostulantes->admision = $this->request->getPost("admision", "int");

                $AdmisionPostulantes->modalidad = 1;
                $AdmisionPostulantes->fecha_inscripcion = date('Y-m-d H:i:s');
                $AdmisionPostulantes->tipo_inscripcion = 0;
                $AdmisionPostulantes->recibo = $this->request->getPost("recibo", "string");
                $AdmisionPostulantes->concepto = 1;
                $AdmisionPostulantes->monto = $this->request->getPost("monto", "string");
                $AdmisionPostulantes->fecha_registro = date('Y-m-d H:i:s');

                //
                $imagenVoucher = $_FILES['file_index_imagen_name']['name'];
                $formatosImagen = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                $fileImagen = $imagenVoucher;

                $extension = pathinfo($fileImagen, PATHINFO_EXTENSION);

                if (in_array($extension, $formatosImagen)) {
                    $AdmisionPostulantes->imagen = $this->request->getPost("imagen_index", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "error_imagen"));
                    $this->response->send();
                    exit();
                }
                //

                $AdmisionPostulantes->proceso = 0;
                $AdmisionPostulantes->estado = "A";

                if ($AdmisionPostulantes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AdmisionPostulantes->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {

                        // Print the real file names and sizes

                        foreach ($this->request->getUploadedFiles() as $file) {

                            if ($file->getKey() == "file_index_imagen_name") {

                                if ($_FILES['file_index_imagen_name']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['file_index_imagen_name']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        $url_destino = 'adminpanel/imagenes/admision/' . 'IMG' . '-' . $AdmisionPostulantes->postulante . "." . $extension;
                                        $AdmisionPostulantes->imagen = 'IMG' . '-' . $AdmisionPostulantes->postulante . "." . $extension;
                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $AdmisionPostulantes->save();
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

    public function inscripcionobservadaAction($id = null)
    {

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        //$verifica = AdmisionPostulantes::findFirst("postulante = {$Postulante->codigo} AND proceso <> 3");
        $verifica = AdmisionPostulantes::findFirst("postulante = {$Postulante->codigo} AND proceso < 3");

        if ($verifica->postulante == $Postulante->codigo) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("registropostulantesa/inscripcionfin");
        }

        $this->view->postulante = $Postulante;

        $categoriaPostulante = CategoriaPostulante::find("estado = 'A' AND numero = 104");
        $this->view->categoriapostulante = $categoriaPostulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $semestres = Semestres::findFirst("activo = 'M'");
        // print($semestres->definicion);
        // exit();
        $this->view->semestre_admision = $semestres;

        //admision m
        $admision_m = Admision::findFirst("activo = 'M'");

        // print("Codigo admision: ".$admision_m->codigo);
        // exit();

        $this->view->admision_m = $admision_m;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //tipo
        $tipo = TipoExamen::find("estado = 'A' AND numero = 22");
        $this->view->tipo = $tipo;

        //concepto
        $concepto = Conceptos::find();
        $this->view->conceptos = $concepto;

        //concepto
        $carreras = Carreras::find("estado = 'A' AND codigo <> '0001'");
        $this->view->carreras = $carreras;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $admision = AdmisionPostulantesa::findFirst(
            [
                "postulante = $Postulante->codigo AND admision = $admision_m->codigo",
            ]
        );
        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/procesoadmisiona.js?v=" . uniqid());
    }

    public function updateInscripcionAction()
    {

        //echo "<pre>";
        //print_r($_FILES['file_imagen']['name']);
        //exit();

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        //         echo "<pre>";
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $postulante = (int) $this->request->getPost("postulante", "int");
                $admision = (int) $this->request->getPost("admision", "int");

                //$Personal = Personal::findFirstByid_personal($id);
                $AdmisionPostulantes = AdmisionPostulantesa::findFirst(
                    [
                        "postulante = $postulante AND admision = $admision",
                    ]
                );
                //Valida cuando es nuevo

                //$AdmisionPostulantes = (!$AdmisionPostulantes) ? new AdmisionPostulantesa() : $AdmisionPostulantes;

                $AdmisionPostulantes->postulante = $this->request->getPost("postulante", "int");
                $AdmisionPostulantes->admision = $this->request->getPost("admision", "int");

                $AdmisionPostulantes->recibo = $this->request->getPost("recibo", "string");
                $AdmisionPostulantes->monto = $this->request->getPost("monto", "string");
                $AdmisionPostulantes->fecha_modificacion = date('Y-m-d H:i:s');
                $AdmisionPostulantes->proceso = 1;

                //$imagen_voucher = $_FILES['file_imagen']['name'];
                //$AdmisionPostulantes->imagen = $imagen_voucher;

                $AdmisionPostulantes->estado = "A";

                if ($AdmisionPostulantes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AdmisionPostulantes->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {

                        // Print the real file names and sizes

                        foreach ($this->request->getUploadedFiles() as $file) {

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "file_inscripcionobservada_imagen_name") {

                                if ($_FILES['file_inscripcionobservada_imagen_name']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['file_inscripcionobservada_imagen_name']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        $url_destino = 'adminpanel/imagenes/admision/' . 'IMG' . '-' . $AdmisionPostulantes->postulante . '-' . $temporal_rand . "." . $extension;
                                        $AdmisionPostulantes->imagen = 'IMG' . '-' . $AdmisionPostulantes->postulante . '-' . $temporal_rand . "." . $extension;
                                        $file->moveTo($url_destino);
                                    } else {

                                        //$this->response->setJsonContent(array("say" => "error_image"));
                                        //$this->response->send();
                                        //exit();
                                    }
                                }
                            }
                        }

                        $AdmisionPostulantes->save();
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

    public function noaptoAction($id = null)
    {
        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $Postulante = Publico::findFirstBycodigo($Postulante->codigo);
        $this->view->postulante = $Postulante;

        $admision_m = Admision::findFirst("activo = 'M'");
        $this->view->admision_m = $admision_m;
    }


    public function resultadosAction()
    {

        $postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);

        // print($postulante->codigo);
        // exit();

        $postulante = Publico::findFirstBycodigo($postulante->codigo);
        $this->view->postulante = $postulante;

        $admisionPostulante = AdmisionPostulantes::findFirstBypostulante($postulante->codigo);
        // print($admisionPostulante->postulante);
        // exit();
        $this->view->admisionPostulante = $admisionPostulante;

        $admision_m = Admision::findFirst("activo = 'M'");
        $this->view->admision_m = $admision_m;

        $admision = Admision::find("estado = 'A'");
        // foreach ($admision as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->descripcion);
        // }
        // exit();
        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/procesoadmisiona.js?v=" . uniqid());
    }

    public function saveContadorAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {


            $postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
            $admisionM = Admision::findFirst("activo = 'M'");


            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admisionM->codigo} AND postulante = {$postulante->codigo}");
            $contador = $admisionPostulantesa->contador + 1;
            $admisionPostulantesa->contador = $contador;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function resultadosnoaptoAction()
    {
        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $Postulante = Publico::findFirstBycodigo($Postulante->codigo);
        $this->view->postulante = $Postulante;

        $admision_m = Admision::findFirst("activo = 'M'");
        $this->view->admision_m = $admision_m;
    }

    public function getresultadosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //  echo"<pre>";
            //  print_r($_POST);
            //  exit();

            $id_admision_enae = $this->request->getPost("id_admision_enae", "int");
            $postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
            // echo"<pre>";
            // print_r("Codigo: ".$postulante->codigo);
            // exit();
            $admisionPostulantes = AdmisionPostulantes::findFirst("postulante = $postulante->codigo AND admision = $id_admision_enae");

            // echo "<pre>";
            // print($admisionPostulantes->postulante);
            // exit();

            if ($admisionPostulantes && $admisionPostulantes->estado = 'A' && $admisionPostulantes->puntaje <> null && $admisionPostulantes->puntaje > 0) {

                // print("Existe Resultados");
                // exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {

                // print("No Existe Resultados");
                // exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }
}
