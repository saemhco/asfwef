<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class WebbibliotecaController extends ControllerBase
{

    public function initialize()
    {


        $this->tag->setTitle('Web');
        //$this->view->setTemplateAfter('webbiblioteca');
        parent::initialize();
    }

    //inicio web biblioteca
    public function indexAction()
    {

        //Validar inicio de sesion
        //if (!$this->session->has('auth')) {
        //return $this->response->redirect("");
        //}

        $auth = $this->session->get('auth');
        $this->view->auth = $auth;

        //libros native model
        $sql_libros = $this->modelsManager->createQuery("SELECT
        libros.titulo,
        categoria.nombres AS categoria,
        idioma.nombres AS idioma,
        editorial.descripcion AS editorial,
        libros.fecha_publicacion AS fecha_lanzamiento,
        libros.paginas AS paginas,
        libros.cantidad_ejemplares AS cantidad_ejemplares,
        libros.isbn AS isbn,
        libros.autor_1 AS autor_1,
        libros.autor_2 AS autor_2,
        libros.autor_3 AS autor_3,
        libros.id_libro AS id_libro,
        libros.imagen AS img,
        ejemplares.numero AS numero,
        autores1.descripcion AS autor1,
        autores2.descripcion AS autor2,
        autores3.descripcion AS autor3,
        ejemplares.id_ejemplar AS id_ejemplar
        FROM
        Libros AS libros
        INNER JOIN Categorias AS categoria ON categoria.codigo = libros.categoria
        INNER JOIN Idiomas AS idioma ON libros.idioma = idioma.codigo
        INNER JOIN Editoriales AS editorial ON libros.editorial = editorial.id_editorial
        INNER JOIN LibrosEjemplares AS ejemplares ON ejemplares.id_libro = libros.id_libro
        LEFT JOIN Autores autores1 ON autores1.id_autor = libros.autor_1
        LEFT JOIN Autores autores2 ON autores2.id_autor = libros.autor_2
        LEFT JOIN Autores autores3 ON autores3.id_autor = libros.autor_3
        WHERE
        libros.cantidad_ejemplares > 0 AND
        categoria.numero = 48 AND
        idioma.numero = 49
        ORDER BY ejemplares.numero_visitas DESC
        LIMIT 6");
        $libros = $sql_libros->execute();
        $this->view->libros = $libros;

        //carga de autores
        $autores = $this->modelsManager->createBuilder()
            ->from('Autores')
            ->columns('Autores.id_autor AS autor_id,
                        Autores.descripcion AS descripcion,
                        Autores.nacionalidad AS nacionalidad')
            ->where("Autores.estado ='A'")
            //->orderBy("Noticias.noticia_id DESC")
            //->orderBy("Noticias.fecha_publicacion DESC")
            ->getQuery()
            ->execute();
        $this->view->autores = $autores;
    }

    //tipspracticas
    public function tipspracticasAction()
    {
    }

    //infointeres
    public function infointeresAction()
    {
        //Cargamos el modelo de empleos
        $empleos = Empleos::find(" estado = 'A' ");
        $this->view->empleos = $empleos;
    }

    //novedades
    public function novedadesAction()
    {

        $numberPage = 1;
        $numberPage = $this->request->getQuery("page", "int");

        $parameters = " estado = 'A' ";

        $novedades = Novedades::find($parameters);

        $paginator = new PaginatorModel([
            "data" => $novedades,
            "limit" => 10,
            "page" => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        //$this->view->novedades = $novedades;
    }

    //listados
    public function listadoAction()
    {

        //cerramos sesion si no la inicio
        //if (!$this->session->has('auth')) {
        //    return $this->response->redirect("");
        //}

        $palabra_clave = "";
        $f_categoria = "";
        $f_idioma = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //echo '<pre>';
        //print_r($full_url);
        //exit();
        //Cargamos el modelo de los distritos

        $where = " libros.estado = 'A' AND librosejemplares.estado = 'A'";
        if ($this->request->isGet()) {

            if (isset($_GET["palabra_clave"])) {
                $palabra_clave = $this->request->getQuery("palabra_clave", "string");
                $where = $where . "AND unaccent(titulo) ILIKE unaccent ( '%$palabra_clave%' ) OR unaccent (isbn) ILIKE unaccent ( '%$palabra_clave%' ) OR unaccent (codigo) ILIKE unaccent ( '%$palabra_clave%' ) OR unaccent (autores1.descripcion) ILIKE unaccent ( '%$palabra_clave%' )OR unaccent (autores2.descripcion) ILIKE unaccent ( '%$palabra_clave%' )OR unaccent (autores3.descripcion) ILIKE unaccent ( '%$palabra_clave%' )";
                //print($where);
                //exit();
            }

            if (isset($_GET["categoria"]) && $_GET["categoria"] != "") {
                $f_categoria = $this->request->getQuery("categoria", "int");

                $where = $where . " AND categoria = " . $f_categoria;
            }
            if (isset($_GET["idioma"]) && $_GET["idioma"] != "") {
                $f_idioma = $this->request->getQuery("idioma", "string");
                $where = $where . " AND idioma = " . $f_idioma;

                //echo '<pre>';
                //print_r($where);
                //exit();
            }
        }
        //
        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        $sql = $this->modelsManager->createQuery("SELECT libros.titulo,
                libros.id_libro,
                libros.fecha_publicacion AS fecha_lanzamiento,
                libros.paginas AS paginas,
                libros.cantidad_ejemplares AS cantidad_ejemplares,
                libros.isbn AS isbn,
                libros.autor_1 AS autor_1,
                libros.autor_2 AS autor_2,
                libros.autor_3 AS autor_3,
                libros.id_libro AS libro_id,
                librosejemplares.numero_visitas AS numero_visitas,
                autores1.descripcion AS autor1,
                autores2.descripcion AS autor2,
                autores3.descripcion AS autor3 ,
                librosejemplares.numero AS numero,
                librosejemplares.id_ejemplar AS id_ejemplar             
                FROM Libros libros
                LEFT JOIN Autores autores1 ON autores1.id_autor = libros.autor_1
                LEFT JOIN Autores autores2 ON autores2.id_autor = libros.autor_2
                LEFT JOIN Autores autores3 ON autores3.id_autor = libros.autor_3
                INNER JOIN LibrosEjemplares librosejemplares ON librosejemplares.id_libro = libros.id_libro
                WHERE $where");
        $libros = $sql->execute();

        // foreach ($libros as $value) {
        //     echo "<pre>";
        //     print_r($value->autores);
        // }
        // exit();

        $data = $libros;




        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 5,
                'page' => $currentPage,
            ]
        );

        $page = $paginator->getPaginate();

        $this->view->page = $page;
        $this->view->f_categoria = $f_categoria;
        $this->view->f_idioma = $f_idioma;
        $this->view->full_url = $full_url;
        $this->view->palabra_clave = $palabra_clave;

        //categorias
        $categorias = Categorias::find("estado = 'A' AND numero = 48");
        $this->view->categorias = $categorias;

        //idioma
        $idiomas = Idiomas::find("estado = 'A' AND numero = 49");
        $this->view->idiomas = $idiomas;
    }

    //testimonios
    public function testimoniosAction()
    {

        $numberPage = 1;
        $numberPage = $this->request->getQuery("page", "int");

        $parameters = "estado = 'A'";

        $testimonios = Testimonios::find($parameters);

        $paginator = new PaginatorModel([
            "data" => $testimonios,
            "limit" => 3,
            "page" => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    //contactenos
    public function contactenosAction()
    {
    }

    //validaregistro
    public function validaregistroAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //print_r($_POST);exit();
            $profesional = new Profesional();
            $profesional->nombres = $this->request->getPost("nombres");
            $profesional->ap_paterno = $this->request->getPost("ap_paterno");
            $profesional->ap_materno = $this->request->getPost("ap_materno");
            $profesional->email = $this->request->getPost("email");
            $profesional->dni = $this->request->getPost("dni");
            $profesional->codigo_estudiante = $this->request->getPost("codigo_estudiante");
            $profesional->telefono = $this->request->getPost("telefono");
            $profesional->direccion = $this->request->getPost("direccion");
            $profesional->password = $this->request->getPost("password");
            $profesional->perfil_id = 3;
            $profesional->estado = "P";

            if ($profesional->save() == false) {
                //echo "<pre>";
                //print_r($profesional->getMessages())                    
                //;exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent($profesional->getMessages());
                $this->response->send();
            } else {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
                $this->response->send();
            }
        }
    }

    public function registrosAction()
    {
    }

    public function detalleAction($id_ejemplar, $id_libro)
    {

        // print("id_libro: ".$id_libro." - id_ejemplar: ".$id_ejemplar);
        // exit();

        $Reservas = LibrosReservasWeb::count();
        $codigo = $Reservas + 1;
        $this->view->codigo = $codigo;

        $sql_libros = $this->modelsManager->createQuery("SELECT DISTINCT
        libros.id_libro,
        libros.titulo,
        categoria.nombres AS categoria,
        idioma.nombres AS idioma,
        editorial.descripcion AS editorial,
        libros.fecha_publicacion,
        libros.paginas AS paginas,
        libros.cantidad_ejemplares AS cantidad_ejemplares,
        libros.isbn AS isbn,
        libros.autor_1 AS autor_1,
        libros.autor_2 AS autor_2,
        libros.autor_3 AS autor_3,
        libros.id_libro AS libro_id,
        libros.imagen,
        libros.anio_publicacion AS anio_publicacion,
        ejemplares.numero AS numero,
        autores1.descripcion AS autor1,
        autores2.descripcion AS autor2,
        autores3.descripcion AS autor3,
        ejemplares.id_ejemplar AS id_ejemplar
        FROM
        Libros AS libros
        INNER JOIN Categorias AS categoria ON categoria.codigo = libros.categoria
        INNER JOIN Idiomas AS idioma ON libros.idioma = idioma.codigo
        INNER JOIN Editoriales AS editorial ON libros.editorial = editorial.id_editorial
        INNER JOIN LibrosEjemplares AS ejemplares ON ejemplares.id_libro = libros.id_libro
        LEFT JOIN Autores autores1 ON autores1.id_autor = libros.autor_1
        LEFT JOIN Autores autores2 ON autores2.id_autor = libros.autor_2
        LEFT JOIN Autores autores3 ON autores3.id_autor = libros.autor_3
        WHERE
        categoria.numero = 48 AND
        idioma.numero = 49 AND
        libros.id_libro = $id_libro AND ejemplares.id_ejemplar = $id_ejemplar");
        $libros = $sql_libros->execute();

        // foreach ($libros as $value) {
        //     echo "<pre>";
        //     print_r($value->id_libro);
        // }
        // exit();

        $this->view->libros = $libros;


        $librosEjemplares = LibrosEjemplares::findFirst("id_libro = $id_libro AND id_ejemplar = $id_ejemplar");
        $librosEjemplares->numero_visitas = $librosEjemplares->numero_visitas + 1;
        $librosEjemplares->save();




        //categorias
        $categorias = Categorias::find("estado = 'A' AND numero = 48");
        $this->view->categorias = $categorias;

        //idioma
        $idiomas = Idiomas::find("estado = 'A' AND numero = 49");
        $this->view->idiomas = $idiomas;

        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //echo '<pre>';
        //print_r($full_url);
        //exit();

        $this->view->full_url = $full_url;

        $this->assets->addJs("adminpanel/js/viewswebbiblioteca/detalle.js?v=" . uniqid());
    }

    //menu categoria
    public function urlCategoriasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $url = Categorias::find("estado = 'A' AND numero = 48");
            $this->response->setJsonContent($url->toArray());
            $this->response->send();
        }
    }

    //menu idioma
    public function urlIdiomasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $url = Idiomas::find("estado = 'A' AND numero = 49");
            $this->response->setJsonContent($url->toArray());
            $this->response->send();
        }
    }

    //consultar inicio de sesion
    public function validaloginAction()
    {
        $this->view->disable();
        $auth = $this->session->get('auth');

        if ($auth != '') {
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("sesion" => 'si'));
        } else {
            $this->response->setJsonContent(array("sesion" => "no"));
        }
        $this->response->send();
    }

    //consulta libro activo
    public function libroactivoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $id_libro = $this->request->getPost("id_libro");
            $id_ejemplar = $this->request->getPost("id_ejemplar");


            $librosEjemplares = LibrosEjemplares::findFirst("id_libro = $id_libro AND id_ejemplar = $id_ejemplar");

            // print("id_libro: ".$librosEjemplares->id_libro. " - ". "id_ejemplar:".$librosEjemplares->id_ejemplar);
            // exit();

            if ($librosEjemplares->activo == 1) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("activo" => 1));
            } elseif($librosEjemplares->activo == 0) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("activo" => 0));
            }
            $this->response->send();
        }
    }

    //validarcv
    public function reservarlibroAction()
    {

        $this->view->disable();
        $auth = $this->session->get('auth');

        //echo '<pre>';
        //print_r($auth);
        //exit();

        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo '<pre>';
                // print_r($_POST);
                // exit();




                $auth = $this->session->get('auth');
                $id_libro = (int) $this->request->getPost("id_libro", "int");
                $id_ejemplar = (int) $this->request->getPost("id_ejemplar", "int");

                //print($codigo);
                //exit();


                switch ($auth['perfil']) {
                    case ($auth['perfil'] == 3):
                        $where = "fecha_entrega IS NULL AND fecha_devolucion_confirmada IS NULL AND codigos ='{$auth['codigo']}' AND alumno = '1' ";
                        break;
                    case ($auth['perfil'] == 4):
                        $where = "fecha_entrega IS NULL AND fecha_devolucion_confirmada IS NULL AND codigos ='{$auth['codigo']}' AND docente = '1' ";
                        break;
                    case ($auth['perfil'] == 5):
                        $where = "fecha_entrega IS NULL AND fecha_devolucion_confirmada IS NULL AND codigos ='{$auth['codigo']}' AND  publico = '1' ";
                        break;
                    case ($auth['perfil'] == 12):
                        $where = "fecha_entrega IS NULL AND fecha_devolucion_confirmada IS NULL AND codigos ='{$auth['id_personal']}' AND administrativo = '1' ";
                        break;
                }

                //echo '<pre>';
                //print_r($where);
                //exit();

                $Reserva = LibrosReservasWeb::count($where);
                //trae los datos si existe pero find solo trae
             
                if ($Reserva>=4) {

                    //echo '<pre>';
                    //print_r("No puede");
                    //exit();

                    $response = array("reservo" => "no");

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no", "reservacion" => $response));
                } else {

                    //echo "hola";exit();
                    date_default_timezone_set('America/Lima');
                    $time = date("H:i:s");

                    $Reserva = new LibrosReservasWeb();
                    //$Reserva->id_libro_prestamo = $this->request->getPost("codigo", "int");
                    //Grabamos el prestamo en la web
                    $Reserva->codigos = $auth['codigo'];

                    //alumnos
                    if ($this->session->get("auth")["perfil"] == 3) {
                        $Reserva->alumno = 1;
                    } else {
                        $Reserva->alumno = 0;
                    }

                    //docentes
                    if ($this->session->get("auth")["perfil"] == 4) {
                        $Reserva->docente = 1;
                    } else {
                        $Reserva->docente = 0;
                    }

                    //publico
                    if ($this->session->get("auth")["perfil"] == 5) {
                        $Reserva->publico = 1;
                    } else {
                        $Reserva->publico = 0;
                    }

                    //administrativo
                    if ($this->session->get("auth")["perfil"] == 12) {
                        $Reserva->administrativo = 1;
                    } else {
                        $Reserva->administrativo = 0;
                    }



                    $Reserva->fecha_reserva = date('Y-m-d');
                    //print_r($time);exit();

                    $Reserva->hora_reserva = $time;

                    $Reserva->estado = 1;
                    $Reserva->tipo = 1;


                    if ($Reserva->save() == false) {


                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent($Reserva->getMessages());
                    } else {

                        //print("id_libro_prestamo: ".$Reserva->id_libro_prestamo);
                        //exit();

                        $Detallealquiler = new PrestamosDetalles();
                        $Detallealquiler->id_libro = $id_libro;
                        $Detallealquiler->id_prestamo = $Reserva->id_libro_prestamo;
                        $Detallealquiler->id_ejemplar = $id_ejemplar;
                        $Detallealquiler->estado = "A";
                        $Detallealquiler->save();


                        if ($Detallealquiler) {

                            $response = array("reservo" => "si");
                            //reservamos libro
                            $librosEjemplares = LibrosEjemplares::findFirst("id_libro = $id_libro AND id_ejemplar = $id_ejemplar");
                            $librosEjemplares->activo = 0;
                            $librosEjemplares->save();
                        } else {

                            //print("Llego aqui");
                            //exit();

                            $response = array("reservo" => "no");
                        }

                        //Cuando va bien 
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes", "reservacion" => $response));
                    }
                }
                //fin
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function loginAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //tipo de usuario
            $tipousuario = $this->request->getPost('tipousuario', 'string');
            //email
            $email = $this->request->getPost('email');
            //password
            $password = $this->request->getPost('password');
            //nro documento cuando es publico
            $nro_doc = $this->request->getPost('nro_doc', 'string');

            //echo '<pre>';
            //print_r("Tipo de ususario:".$tipousuario.'-'."Email:".$email.'-'."Password:".$password);
            //exit();

            if ($tipousuario == 1) {
                //login alumnos
                $where = " estado = 'A' AND email1 = '" . $email . "'";
                $user = Alumnos::findFirst($where);
                //
                if ($user) {
                    $pass = $user->password;
                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'perfil' => 3
                        ]);

                        $auth = $this->session->get('auth');
                        $nombre_usuario = $auth["nombres"];

                        //echo '<pre>';
                        //print_r($auth);
                        //exit();

                        $this->response->setJsonContent(array("say" => "yes", "nombre_usuario" => $nombre_usuario));
                        $this->response->send();
                    } else {

                        $this->response->setJsonContent(array("say" => "password_alumno_incorrecto"));
                        $this->response->send();
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "alumno_no_existe"));
                    $this->response->send();
                }
                //
            } elseif ($tipousuario == 2) {
                //login docentes
                $where = " estado = 'A' AND email1 = '" . $email . "'";
                $user = Docentes::findFirst($where);
                //
                if ($user) {
                    $pass = $user->password;
                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'full_name' => $user->apellidop . " " . $user->apellidom . " " . $user->nombres,
                            'perfil' => 4
                        ]);

                        $auth = $this->session->get('auth');
                        $nombre_usuario = $auth["nombres"];

                        //echo '<pre>';
                        //print_r($auth);
                        //exit();

                        $this->response->setJsonContent(array("say" => "yes", "nombre_usuario" => $nombre_usuario));
                        $this->response->send();
                    } else {

                        $this->response->setJsonContent(array("say" => "password_docente_incorrecto"));
                        $this->response->send();
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "docente_no_existe"));
                    $this->response->send();
                }
                //
            } elseif ($tipousuario == 3) {
                //login administrativos

                // print("Testing by Ken Mack");
                // exit();

                $where = " estado = 'A' AND email1 = '" . $email . "'";
                $user = Personal::findFirst($where);
                //
                if ($user) {
                    $pass = $user->password;
                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'perfil' => 12
                        ]);
                        $auth = $this->session->get('auth');
                        $nombre_usuario = $auth["nombres"];

                        //echo '<pre>';
                        //print_r($auth);
                        //exit();

                        $this->response->setJsonContent(array("say" => "yes", "nombre_usuario" => $nombre_usuario));
                        $this->response->send();
                    } else {

                        $this->response->setJsonContent(array("say" => "password_administrativo_incorrecto"));
                        $this->response->send();
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "administrativo_no_existe"));
                    $this->response->send();
                }
                //
            } elseif ($tipousuario == 5) {


                //Login publico
                $where = " estado = 'A' AND nro_doc = '" . $nro_doc . "'";
                $user = Publico::findFirst($where);
                //
                if ($user) {
                    $pass = $user->password;
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'perfil' => 5
                        ]);

                        $auth = $this->session->get('auth');
                        $nombre_usuario = $auth["nombres"];

                        //echo '<pre>';
                        //print_r($auth);
                        //exit();

                        $this->response->setJsonContent(array("say" => "yes", "nombre_usuario" => $nombre_usuario));
                        $this->response->send();
                    } else {

                        $this->response->setJsonContent(array("say" => "password_publico_incorrecto"));
                        $this->response->send();
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "publico_no_existe"));
                    $this->response->send();
                }
                //
            } else {

                $this->response->setJsonContent(array("say" => "datos_no_existen"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //espera
    public function esperaAction()
    {
    }

    //detallenovedades
    public function detallenovedadesAction($id)
    {

        //Cargamos el modelo de empleos
        $novedades = Novedades::findFirstBynovedad_id((int) $id);
        $this->view->novedades = $novedades;
    }
}
