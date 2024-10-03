<?php

class RegistroempresasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroempresas.js?v" . uniqid());
    }

    public function indexAction() {
        
    }

    //new
    //Funcion para agregar docente y editar
    public function registroAction($id = null) {

        if ($id != null) {
            $Empresas = Empresas::findFirstByid_empresa((int) $id);
        } else {
            $Empresas = Empresas::findFirstByid_empresa(0);
        }

        $this->view->empresas = $Empresas;

        //Region para ubigeo
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //modalidad
        $tipo_persona = TipoPersona::find("estado = 'A' AND numero = 2");
        $this->view->tipo_persona = $tipo_persona;
    }

    public function saveAction() {
        //echo "<pre>";
        //print_r($_POST);
        //echo "<pre>";
        //print_r($_FILES);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                /* if ($this->request->hasFiles() == true) {
                  echo "entro";
                  echo "<pre>";
                  print_r($_POST);
                  echo "<pre>";
                  print_r($_FILES);
                  }else{
                  echo "no entro";
                  }
                  exit(); */

                $id = (int) $this->request->getPost("id_empresa", "int");
                $Empresas = Empresas::findFirstByid_empresa($id);
                $Empresas = (!$Empresas) ? new Empresas() : $Empresas;

                $Empresas->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Empresas->ruc = $this->request->getPost("ruc", "string");
                $Empresas->rubro = $this->request->getPost("rubro", "string");
                $Empresas->telefono = $this->request->getPost("telefono", "string");
                $Empresas->direccion = $this->request->getPost("direccion", "string");
                $Empresas->email = $this->request->getPost("email", "string");

                $pass_bcrypt = $this->request->getPost("ruc", "string") . 'UNCA';
                $Empresas->password = $this->security->hash($pass_bcrypt);

                $Empresas->representante = $this->request->getPost("representante", "string");

                $Empresas->estado = "A";

                $bolsa_trabajo = $this->request->getPost("bolsa_trabajo", "string");
                if (isset($bolsa_trabajo)) {
                    $Empresas->bolsa_trabajo = "1";
                } else {
                    $Empresas->bolsa_trabajo = "0";
                }

                $Empresas->perfil = 2;
                //comprueba si hay archivos por subir
                //$Empresas->imagen = "imagen.jpg";
                //
                $Empresas->giro = $this->request->getPost("giro", "string");
                $Empresas->fecha_registro = date("Y-m-d H:i:s");
                $Empresas->cta_cte_detraccion = $this->request->getPost("cta_cte_detraccion", "string");
                $Empresas->cci = $this->request->getPost("cci", "string");
                $Empresas->cargo = $this->request->getPost("cargo", "string");
                $Empresas->nro_doc = $this->request->getPost("nro_doc", "string");
                $Empresas->fax = $this->request->getPost("fax", "string");
                $Empresas->celular = $this->request->getPost("celular", "string");
                $Empresas->pais = $this->request->getPost("pais", "string");
                $Empresas->region = $this->request->getPost("region", "string");
                $Empresas->provincia = $this->request->getPost("provincia", "string");
                $Empresas->distrito = $this->request->getPost("distrito", "string");
                $Empresas->ubigeo = $this->request->getPost("ubigeo", "string");
                $Empresas->referencia = $this->request->getPost("referencia", "string");

                if ($this->request->getPost("tipo", "int") == "") {
                    $Empresas->tipo = null;
                } else {
                    $Empresas->tipo = $this->request->getPost("tipo", "int");
                }

                $boleta = $this->request->getPost("boleta", "string");
                if (isset($boleta)) {
                    $Empresas->boleta = "1";
                } else {
                    $Empresas->boleta = "0";
                }


                $factura = $this->request->getPost("factura", "string");
                if (isset($factura)) {
                    $Empresas->factura = "1";
                } else {
                    $Empresas->factura = "0";
                }



                $rnp = $this->request->getPost("rnp", "string");
                if (isset($rnp)) {
                    $Empresas->rnp = "1";
                } else {
                    $Empresas->rnp = "0";
                }


                $mype = $this->request->getPost("mype", "string");
                if (isset($mype)) {
                    $Empresas->mype = "1";
                } else {
                    $Empresas->mype = "0";
                }



                $entidad_publica = $this->request->getPost("entidad_publica", "string");
                if (isset($entidad_publica)) {
                    $Empresas->entidad_publica = "1";
                } else {
                    $Empresas->entidad_publica = "0";
                }

                //imagen
                $imagen = $this->request->getPost("imagen", "string");
                if ($imagen) {
                    $Empresas->imagen = $this->request->getPost("imagen", "string");
                } else {

                    $imagen = $_FILES['imagen']['name'];
                    if ($imagen == "") {

                        $Empresas->imagen = null;
                    } else {
                        $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                        $file_imagen = $_FILES['imagen']['name'];
                        $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                        if (in_array($extension, $formatos_imagenes)) {
                            $Empresas->imagen = "imagen" . $extension;
                        } else {
                            $this->response->setJsonContent(array("say" => "error_imagen"));
                            $this->response->send();
                            exit();
                        }
                    }
                }

                //archivo_ruc
                $archivo_ruc = $this->request->getPost("archivo_ruc", "string");
                if ($archivo_ruc) {
                    $Empresas->archivo_ruc = $this->request->getPost("archivo_ruc", "string");
                } else {

                    $archivo_ruc = $_FILES['archivo_ruc']['name'];
                    if ($archivo_ruc == "") {

                        $Empresas->archivo_ruc = null;
                    } else {
                        $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                        $file_archivo = $_FILES['archivo_ruc']['name'];
                        $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                        if (in_array($extension, $formatos_archivo)) {
                            $Empresas->archivo_ruc = "archivo_ruc" . $extension;
                        } else {
                            $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                            $this->response->send();
                            exit();
                        }
                    }
                }

                //archivo_rnp
                $archivo_rnp = $this->request->getPost("archivo_rnp", "string");
                if ($archivo_rnp) {
                    $Empresas->archivo_rnp = $this->request->getPost("archivo_rnp", "string");
                } else {

                    $archivo_rnp = $_FILES['archivo_rnp']['name'];
                    if ($archivo_rnp == "") {

                        $Empresas->archivo_rnp = null;
                    } else {
                        $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                        $file_archivo = $_FILES['archivo_rnp']['name'];
                        $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                        if (in_array($extension, $formatos_archivo)) {
                            $Empresas->archivo_rnp = "archivo_rnp" . $extension;
                        } else {
                            $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                            $this->response->send();
                            exit();
                        }
                    }
                }
                //


                if ($Empresas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empresas->getMessages());
                } else {
                    //Cuando va bien                  
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {
                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {
                                        if (isset($Empresas->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/empresas/' . $Empresas->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/empresas/' . 'IMG' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->imagen = 'IMG' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/empresas/' . 'IMG' . '-' . $Empresas->id_empresa . '.' . $extension;
                                            $Empresas->imagen = 'IMG' . '-' . $Empresas->id_empresa . '.' . $extension;
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
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                if ($_FILES['archivo_ruc']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_ruc']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo_ruc)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo_ruc;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo_ruc = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo_ruc = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_rnp
                            if ($file->getKey() == "archivo_rnp") {

                                if ($_FILES['archivo_rnp']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_rnp']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo_rnp;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo_rnp = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo_rnp = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Empresas->save();
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Empresas = Empresas::findFirstByid_empresa((int) $this->request->getPost("id", "int"));
            if ($Empresas) {
                $this->response->setJsonContent($Empresas->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Empresas = Empresas::findFirstByid_empresa((int) $this->request->getPost("id", "int"));
            if ($Empresas && $Empresas->estado = 'A') {
                $Empresas->estado = 'X';
                $Empresas->save();
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

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_empresa");
            $datatable->setSelect("id_empresa,ruc, razon_social, imagen, rubro,telefono,direccion,email,estado");
            $datatable->setFrom("tbl_btr_empresas");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //validar personal registrado
    public function empresasRegistradoAction() {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Empresas = Empresas::findFirstByruc((string) $this->request->getPost("ruc", "string"));

            if ($Empresas) {
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

}
