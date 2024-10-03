<?php

class MoodleController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

    }

    public function indexAction() {
        
    }

    //Funcion agregar Evento y editar
    public function usuariosAction($id = null) {
        
        //eventos.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/moodle.usuarios.js?v=" . uniqid());
    }

    public function cursosAction($id = null) {
        $categorias = MoodleCategoria::find("visible=1");
        $this->view->categorias = $categorias;
        //eventos.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/moodle.cursos.js?v=" . uniqid());
    }

    public function categoriasAction($id = null) {
        
        //eventos.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/moodle.categorias.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableUsuariosAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di,'db2');
            $datatable->setColumnaId("idnumber");
            $datatable->setSelect("idnumber, id,firstname, lastname, email, address, city, password");
            $datatable->setFrom("mdl_user");
            $datatable->setWhere("deleted = 0");
            $datatable->setOrderby("idnumber");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatableCursosAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di,'db2');
            $datatable->setColumnaId("idnumber");
            $datatable->setSelect("idnumber,id, shortname, fullname");
            $datatable->setFrom("mdl_course");
            $datatable->setWhere("visible = 1");
            $datatable->setOrderby("idnumber");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatableCategoriasAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di,'db2');
            $datatable->setColumnaId("id");
            $datatable->setSelect("id, idnumber, name");
            $datatable->setFrom("mdl_course_categories");
            $datatable->setWhere("visible = 1");
            $datatable->setOrderby("id");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }



    public function saveUserAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = $this->request->getPost("idnumber", "string");
                $Usuario = MoodleUsuario::findFirstByidnumber($id);
                $Usuario = (!$Usuario) ? new MoodleUsuario() : $Usuario;
                $Usuario->firstname = strtoupper($this->request->getPost("firstname", "string"));
                $Usuario->lastname = $this->request->getPost("lastname", "string");
                $Usuario->username = $this->request->getPost("email", "string");
                $Usuario->email = $this->request->getPost("email", "string");
                $Usuario->phone1 = $this->request->getPost("phone1", "string");
                $Usuario->phone2 = $this->request->getPost("phone2", "string");
                //$Usuario->idnumber = $this->request->getPost("email", "string");

                $Usuario->address = $this->request->getPost("address", "string");
                $Usuario->city = $this->request->getPost("city", "string");
                $Usuario->country = $this->request->getPost("country", "string");

                $Usuario->confirmed = 1;
                $Usuario->policyagreed = 1;
                $Usuario->mnethostid = 1;
                $Usuario->auth = 'manual';
                $Usuario->lang = 'es';


                if ($id == "") {
                    $options = array();
                    $text = $this->moodlePass($this->request->getPost("password"),1,$options);
                    $Usuario->password = $text;
                } 
              

                if ($Usuario->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Usuario->getMessages());
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

    public function saveCursoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = $this->request->getPost("id","string");
                $Curso = MoodleCurso::findFirstByid($id);
                $Curso = (!$Curso) ? new MoodleCurso() : $Curso;
                $Curso->fullname = strtoupper($this->request->getPost("fullname", "string"));
                $Curso->shortname = $this->request->getPost("shortname", "string");
                $Curso->category = $this->request->getPost("category", "int");
                $Curso->idnumber = $this->request->getPost("idnumber", "string");
                $Curso->summary = $this->request->getPost("shortname", "string");                
                $Curso->newsitems  = 3;
                $Curso->visible = 1;


                if ($Curso->save() == false) {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Curso->getMessages());
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

    public function saveCategoriaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = $this->request->getPost("id", "string");
                $Categoria = MoodleCategoria::findFirstByid($id);
                $Categoria = (!$Categoria) ? new MoodleCategoria() : $Categoria;
                $Categoria->name = strtoupper($this->request->getPost("name", "string"));
                $Categoria->idnumber = $this->request->getPost("idnumber", "string");

                $Categoria->visible = 1;

                if ($id == "") {
                    $Categoria->id = (int)$this->request->getPost("idnumber", "int");
                }

                if ($Categoria->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Categoria->getMessages());
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

    public function eliminarCategoriaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $MoodleCategoria = MoodleCategoria::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($MoodleCategoria && $MoodleCategoria->visible = 1) {
                $MoodleCategoria->visible = 0;
                $MoodleCategoria->save();
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

    public function eliminarCursoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $MoodleCurso = MoodleCurso::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($MoodleCurso && $MoodleCurso->visible = 1) {
                $MoodleCurso->visible = 0;
                $MoodleCurso->save();
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

    public function eliminarUsuarioAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $MoodleUsuario = MoodleUsuario::findFirstByidnumber($this->request->getPost("id", "string"));
            if ($MoodleUsuario && $MoodleUsuario->deleted = 0) {
                $MoodleUsuario->deleted = 1;
                $MoodleUsuario->save();
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

    public function getAjaxUsuarioAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Usuario = MoodleUsuario::findFirstByidnumber($this->request->getPost("id", "string"));
            if ($Usuario) {
                $this->response->setJsonContent($Usuario->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxCategoriaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Categoria = MoodleCategoria::findFirstByid($this->request->getPost("id", "string"));
            if ($Categoria) {
                $this->response->setJsonContent($Categoria->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxCursoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Curso = MoodleCurso::findFirstByidnumber($this->request->getPost("id", "string"));
            if ($Curso) {
                $this->response->setJsonContent($Curso->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function migrarUsuariosAction(){

            $registros = VMoodleAlumnos::find();
            foreach ($registros as $key => $value) {

                $gUsuario = MoodleUsuario::findFirstByidnumber($value->email1);
                if (!$gUsuario) {
                    $Usuario = new MoodleUsuario();
                    $Usuario->firstname = $value->nombres;
                    $Usuario->lastname = $value->apellidos;
                    $Usuario->username = $value->email1;
                    $Usuario->email = $value->email1;
                    $Usuario->phone1 = $value->telefono;
                    $Usuario->phone2 = $value->celular;
                    $Usuario->idnumber = $value->email1;

                    if($value->direccion == ""){
                        $direccion = "-";
                    }else{
                        $direccion = $value->direccion;
                    }

                    $pais = substr($value->pais, 0, 2);
                    $pais = strtoupper($pais);

                    $Usuario->address = $direccion;
                    $Usuario->city = $value->ciudad;
                    $Usuario->country = $pais;
                    $Usuario->icq = $value->icq;

                    $options = array();
                    $text = $this->moodlePass($value->dni,1,$options);
                    $Usuario->password = $text;

                    $Usuario->confirmed = 1;
                    $Usuario->policyagreed = 1;
                    $Usuario->mnethostid = 1;
                    $Usuario->auth = 'manual';
                    $Usuario->lang = 'es';
                    $Usuario->save();
                }
            }

            $registros = VMoodleDocentes::find();
            foreach ($registros as $key => $value) {

                $gUsuario = MoodleUsuario::findFirstByidnumber($value->email1);
                if (!$gUsuario) {
                    $Usuario = new MoodleUsuario();
                    $Usuario->firstname = $value->nombres;
                    $Usuario->lastname = $value->apellidos;
                    $Usuario->username = $value->email1;
                    $Usuario->email = $value->email1;
                    $Usuario->phone1 = $value->telefono;
                    $Usuario->phone2 = $value->celular;
                    $Usuario->idnumber = $value->email1;

                    if($value->direccion == ""){
                        $direccion = "-";
                    }else{
                        $direccion = $value->direccion;
                    }

                    $pais = substr($value->pais, 0, 2);
                    $pais = strtoupper($pais);

                    $Usuario->address = $direccion;
                    $Usuario->city = $value->ciudad;
                    $Usuario->country = $pais;
                    $Usuario->icq = $value->icq;

                    $options = array();
                    $text = $this->moodlePass($value->dni,1,$options);
                    $Usuario->password = $text;

                    $Usuario->confirmed = 1;
                    $Usuario->policyagreed = 1;
                    $Usuario->mnethostid = 1;
                    $Usuario->auth = 'manual';
                    $Usuario->lang = 'es';
                    $Usuario->save();
                }
            }
            

            
    }

    public function limpiarBdMoodleAction(){

        $this->db->query("
                update alumnos set rol = 0, moodle = 0;
                update carreras set moodle = 0;
                update docentes set rol = 0, moodle = 0;
                update docentes_asignaturas set rol = 0, moodle = 0, context = 0;
            ");

        $this->db2->query("
                delete from mdl_user;
                delete from mdl_user_enrolments;
                delete from mdl_course;
                delete from mdl_course_categories;
                delete from mdl_course_modules;
                delete from mdl_course_sections;
                delete from mdl_course_format_options;
                delete from mdl_enrol;
                delete from mdl_role_assignments;
                delete from mdl_context;
                delete from mdl_resource;
                delete from mdl_lesson;
                delete from mdl_grade_items;
                delete from mdl_grade_items_history;
                ALTER TABLE mdl_user AUTO_INCREMENT = 1;
                ALTER TABLE mdl_user_enrolments AUTO_INCREMENT = 1;
                ALTER TABLE mdl_course AUTO_INCREMENT = 1;
                ALTER TABLE mdl_course_categories AUTO_INCREMENT = 1;
                ALTER TABLE mdl_course_sections AUTO_INCREMENT = 1;
                ALTER TABLE mdl_course_modules AUTO_INCREMENT = 1;
                ALTER TABLE mdl_enrol AUTO_INCREMENT = 1;
                ALTER TABLE mdl_role_assignments AUTO_INCREMENT = 1;
                ALTER TABLE mdl_context AUTO_INCREMENT = 1;
                ALTER TABLE mdl_course_format_options AUTO_INCREMENT = 1;
                ALTER TABLE mdl_resource AUTO_INCREMENT = 1;
                ALTER TABLE mdl_lesson AUTO_INCREMENT = 1;
                ALTER TABLE mdl_grade_items AUTO_INCREMENT = 1;
                ALTER TABLE mdl_grade_items_history AUTO_INCREMENT = 1;
            ");

        $this->db2->query("
                 INSERT INTO `mdl_context` (`id`, `contextlevel`, `instanceid`, `path`, `depth`, `locked`) VALUES
                    (1, 10, 0, '/1', 1, 0),
                    (2, 50, 1, '/1/2', 2, 0),
                    (3, 40, 1, '/1/3', 2, 0),
                    (4, 30, 1, '/1/4', 2, 0),
                    (5, 30, 2, '/1/5', 2, 0),
                    (6, 80, 1, '/1/6', 2, 0),
                    (7, 80, 2, '/1/7', 2, 0),
                    (8, 80, 3, '/1/8', 2, 0),
                    (9, 80, 4, '/1/9', 2, 0),
                    (10, 80, 5, '/1/10', 2, 0),
                    (11, 80, 6, '/1/11', 2, 0),
                    (12, 80, 7, '/1/12', 2, 0),
                    (13, 80, 8, '/1/13', 2, 0),
                    (14, 80, 9, '/1/14', 2, 0),
                    (15, 80, 10, '/1/15', 2, 0),
                    (16, 80, 11, '/1/5/16', 3, 0),
                    (17, 80, 12, '/1/5/17', 3, 0),
                    (18, 80, 13, '/1/5/18', 3, 0),
                    (19, 80, 14, '/1/5/19', 3, 0),
                    (20, 80, 15, '/1/5/20', 3, 0),
                    (21, 80, 16, '/1/5/21', 3, 0),
                    (22, 80, 17, '/1/5/22', 3, 0),
                    (23, 80, 18, '/1/5/23', 3, 0),
                    (24, 80, 19, '/1/5/24', 3, 0);

            ");

        $this->db2->query("
                INSERT INTO `mdl_user` (`id`, `auth`, `confirmed`, `policyagreed`, `deleted`, `suspended`, `mnethostid`, `username`, `password`, `idnumber`, `firstname`, `lastname`, `email`, `emailstop`, `icq`, `skype`, `yahoo`, `aim`, `msn`, `phone1`, `phone2`, `institution`, `department`, `address`, `city`, `country`, `lang`, `calendartype`, `theme`, `timezone`, `firstaccess`, `lastaccess`, `lastlogin`, `currentlogin`, `lastip`, `secret`, `picture`, `url`, `description`, `descriptionformat`, `mailformat`, `maildigest`, `maildisplay`, `autosubscribe`, `trackforums`, `timecreated`, `timemodified`, `trustbitmask`, `imagealt`, `lastnamephonetic`, `firstnamephonetic`, `middlename`, `alternatename`) VALUES
            (1, 'manual', 1, 0, 0, 0, 1, 'guest', '$2y$10$aZPBkn1UZ/pOKxz7OJ6zWunI8L0Tk4VGQugG0/cimrdyKwo0G7fNu', '', 'Invitado', ' ', 'root@localhost', 0, '', '', '', '', '', '', '', '', '', '', 'HUAMACHUCO', 'PE', 'es_co', 'gregorian', '', '99', 0, 0, 0, 0, '', '', 0, '', 'Este usuario sólo tiene acceso de lectura en ciertos cursos.', 1, 1, 0, 2, 1, 0, 0, 1591362492, 0, NULL, NULL, NULL, NULL, NULL),
            (2, 'manual', 1, 0, 0, 0, 1, 'admin', '$2y$10$zdYK6H8MCa3hvoMG9R2fPOIn.Wm7U7I/gPCfIm06HrQfYOjy1qONG', '', 'AULA VIRTUAL', 'UNCA', 'tic@unca.edu.pe', 0, '', '', '', '', '', '', '', '', '', '', 'HUAMACHUCO', 'PE', 'es_co', 'gregorian', '', '99', 1591362576, 1591419236, 1591414909, 1591419236, '190.239.72.112', '', 0, '', '', 1, 1, 0, 1, 1, 0, 0, 1591363863, 0, NULL, '', '', '', '');
            ");

        $this->db2->query("

            ALTER TABLE `mdl_user`
              MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
            COMMIT;

            INSERT INTO `mdl_course` (`id`, `category`, `sortorder`, `fullname`, `shortname`, `idnumber`, `summary`, `summaryformat`, `format`, `showgrades`, `newsitems`, `startdate`, `enddate`, `relativedatesmode`, `marker`, `maxbytes`, `legacyfiles`, `showreports`, `visible`, `visibleold`, `groupmode`, `groupmodeforce`, `defaultgroupingid`, `lang`, `calendartype`, `theme`, `timecreated`, `timemodified`, `requested`, `enablecompletion`, `completionnotify`, `cacherev`) VALUES
            (1, 0, 0, 'Aula Virtual UNCA', 'UNCA', '', '', 0, 'site', 1, 3, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, '', '', '', 1591362492, 1591363924, 0, 0, 0, 1591362533);

            INSERT INTO `mdl_course_format_options` (`id`, `courseid`, `format`, `sectionid`, `name`, `value`) VALUES
            (1, 1, 'site', 0, 'numsections', '1');

  
        ");
    }

    public function sincronizarUsuariosAction(){
        $this->view->disable();
        if ($this->request->isAjax()) {

            $this->limpiarBdMoodleAction();

            $this->migrarUsuariosAction();

            $registros = MoodleUsuario::find();

            foreach ($registros as $key => $value) {

                switch ($value->icq) {
                    case '3':
                        $Docente = Docentes::findFirstByemail1($value->idnumber);
                        if ($Docente){
                            $Docente->moodle = $value->id;
                            $Docente->save();
                        }
                        break;
                    case '4':
                        $Docente = Docentes::findFirstByemail1($value->idnumber);
                        if ($Docente){
                            $Docente->moodle = $value->id;
                            $Docente->save();
                        }
                        break;
                    case '5':
                        $Usuario = Alumnos::findFirstByemail1($value->idnumber);
                        //print $value->idnumber."<br>";
                        //print $value->id;
                        //print $Usuario->idnumber;
                        if ($Usuario){
                            $Usuario->moodle = $value->id;
                            $Usuario->save();
                        }
                        //exit();
                        break;
                        
                    default:
                        break;
                }

                
            }

           

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
            
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function sincronizaRoleMoodleAction(){
        $this->view->disable();
        if ($this->request->isAjax()) {

            $registros = VMoodleMatriculasAlumnos::find();
            foreach ($registros as $key => $value) {
                $userid = $value->id_user;
                $contextid = $value->context_course;
                $roleid =$value->rol;

                if($userid == "" || $contextid == ""){

                }else{
                     $gdata = MoodleAsignaRol::findFirst(" userid={$userid} AND contextid={$contextid} AND roleid={$roleid} ");
                    if (!$gdata) {
                        $AsignaRol = new MoodleAsignaRol();
                        $AsignaRol->roleid = $roleid;
                        $AsignaRol->contextid =  $contextid;
                        $AsignaRol->userid = $userid;
                        
                        
                        $AsignaRol->save();

                      
                            $Alumno = Alumnos::findFirstByemail1($value->email1);
                            if ($Alumno){
                                $Alumno->rol = $AsignaRol->id;
                                $Alumno->save();
                            }
                        
                    }else{
                        
                            $Alumno = Alumnos::findFirstByemail1($value->email1);
                            if ($Alumno){
                                $Alumno->rol = $gdata->id;
                                $Alumno->save();
                            }
                    
                    }
                }
               
            }

            $registros = VMoodleMatriculasDocentes::find();
            foreach ($registros as $key => $value) {
                $userid = $value->id_user;
                $contextid = $value->context_course;
                $roleid = $value->rol;

                if($userid == "" || $contextid == ""){

                }else{
                     $gdata = MoodleAsignaRol::findFirst(" userid={$userid} AND contextid={$contextid} AND roleid={$roleid} ");
                    if (!$gdata) {
                        $AsignaRol = new MoodleAsignaRol();
                        $AsignaRol->roleid = $roleid;
                        $AsignaRol->contextid =  $contextid;
                        $AsignaRol->userid = $userid;
                        

                        $AsignaRol->save();

                        $Docente = Docentes::findFirstByemail1($value->email1);
                        if ($Docente){
                                $Docente->rol = $AsignaRol->id;
                                $Docente->save();
                        }
                    
                    }else{
                        
                        $Docente = Docentes::findFirstByemail1($value->email1);
                        if ($Docente){
                                $Docente->rol = $gdata->id;
                                $Docente->save();
                        }
                    
                    }
                }
               
            }
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function sincronizarCursosRolAction(){
        $this->view->disable();
        if ($this->request->isAjax()) {

            $registros = VMoodleCursos::find();
            foreach ($registros as $key => $value) {
                $courseid = $value->moodle;
                $roleid = 5;

                if($courseid == "" || $roleid == ""){

                }else{
                     $gdata = MoodleEnrol::findFirst(" courseid={$courseid} AND roleid={$roleid} ");
                    if (!$gdata) {
                        $AsignaRol = new MoodleEnrol();
                        $AsignaRol->roleid = $roleid;
                        $AsignaRol->enrol = 'manual';
                        $AsignaRol->courseid = $courseid;

                        $AsignaRol->save();

                       
                            $DocenteA = DocentesAsignaturas::findFirstBymoodle($value->moodle);
                            if ($DocenteA){
                                $DocenteA->rol = $AsignaRol->id;
                                $DocenteA->save();
                            }
                        
                    }else{
                        
                            $DocenteA = DocentesAsignaturas::findFirstBymoodle($value->moodle);
                            if ($DocenteA){
                                $DocenteA->rol = $gdata->id;
                                $DocenteA->save();
                            }
                        
                    }
                }
               
            }
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function sincronizarMatriculaMoodleAction(){
        $this->view->disable();
        if ($this->request->isAjax()) {

            $registros = VMoodleMatriculasAlumnos::find();
            foreach ($registros as $key => $value) {
                $userid = $value->id_user;
                $enrolid = $value->rol_course;

                if($userid == "" || $enrolid == ""){

                }else{
                     $gdata = MoodleUserEnrol::findFirst(" userid={$userid} AND enrolid={$enrolid} ");
                    if (!$gdata) {
                        $AsignaRol = new MoodleUserEnrol();
                        $AsignaRol->enrolid = $enrolid;
                        $AsignaRol->userid = $userid;

                        $AsignaRol->save();
                        
                    }
                }
               
            }

            $registros = VMoodleMatriculasDocentes::find();
            foreach ($registros as $key => $value) {
                $userid = $value->id_user;
                $enrolid = $value->rol_course;

                if($userid == "" || $enrolid == ""){

                }else{
                     $gdata = MoodleUserEnrol::findFirst(" userid={$userid} AND enrolid={$enrolid} ");
                    if (!$gdata) {
                        $AsignaRol = new MoodleUserEnrol();
                        $AsignaRol->enrolid = $enrolid;
                        $AsignaRol->userid = $userid;

                        $AsignaRol->save();
                        
                    }
                }
               
            }
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function sincronizarCursosAction(){
        $this->view->disable();
        if ($this->request->isAjax()) {

            $this->migrarCursosAction();

            $registros = MoodleCurso::find();
            foreach ($registros as $key => $value) {

                $explode = explode(" - ", $value->idnumber);

                if (count($explode) > 1) {
                        $curso = trim($explode[0]);
                        $grupo = trim($explode[1]);
                        $grupo = (int)$grupo;

                        $DCurso = DocentesAsignaturas::findFirst("asignatura='{$curso}' AND grupo={$grupo} ");
                        if ($DCurso){
                            $DCurso->moodle = $value->id;
                            $DCurso->save();
                        }
                }
               
                
            }
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
            
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function migrarCategoriasAction(){
        $this->view->disable();
        if ($this->request->isAjax()) {

            $registros = VMoodleCategorias::find();
            foreach ($registros as $key => $value) {

                $gCategoria = MoodleCategoria::findFirstByidnumber($value->id_number);
                if (!$gCategoria) {
                    $Categoria = new MoodleCategoria();
                    $Categoria->name = $value->name;
                    $Categoria->idnumber = $value->id_number;
                    $Categoria->id = (int)$value->id_number;
                    $Categoria->visible = 1;
                    $Categoria->save();
                }
            }
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function migrarCursosAction(){
        

            $registros = VMoodleCursos::find();
            foreach ($registros as $key => $value) {

                $gCurso = MoodleCurso::findFirstByidnumber($value->asignatura_id_number);
                if (!$gCurso) {
                    $Curso = new MoodleCurso();
                    $Curso->fullname = $value->asignatura_full_name;
                    $Curso->shortname = $value->asignatura_short_name;
                    $Curso->category = (int)$value->categoria;
                    $Curso->idnumber = $value->asignatura_id_number;
                    $Curso->summary = $value->asignatura_short_name;
                    $Curso->newsitems = 3; 
                    $Curso->visible = 1;
                    $Curso->save();
                    
                    $CursoModulo = new MoodleCursoModulo();
                    $CursoModulo->course = $Curso->id;
                    $CursoModulo->section = 0;
                    $CursoModulo->visible = 1;
                    $CursoModulo->save();
                    
                    $CursoRecurso = new MoodleCursoRecurso();
                    $CursoRecurso->course = $Curso->id;
                    $CursoRecurso->name = "Tema ...";
                    $CursoRecurso->save();
                    
                    $CursoLeccion = new MoodleCursoLeccion();
                    $CursoLeccion->course = $Curso->id;
                    $CursoLeccion->name = "Sillabus";
                    $CursoLeccion->save();

                    $CursoSeccion0 = new MoodleCursoSeccion();
                    $CursoSeccion0->course = $Curso->id;
                    $CursoSeccion0->section = 0;
                    $CursoSeccion0->name = "General";
                    $CursoSeccion0->visible = 1;
                    $CursoSeccion0->save();

                    $CursoSeccion1 = new MoodleCursoSeccion();
                    $CursoSeccion1->course = $Curso->id;
                    $CursoSeccion1->section = 1;
                    $CursoSeccion1->name = "Unidad 1";
                    $CursoSeccion1->visible = 1;
                    $CursoSeccion1->save();

                    $CursoSeccion2 = new MoodleCursoSeccion();
                    $CursoSeccion2->course = $Curso->id;
                    $CursoSeccion2->section = 2;
                    $CursoSeccion2->name = "Unidad 2";
                    $CursoSeccion2->visible = 1;
                    $CursoSeccion2->save();
                    
                    $CursoSeccion3 = new MoodleCursoSeccion();
                    $CursoSeccion3->course = $Curso->id;
                    $CursoSeccion3->section = 3;
                    $CursoSeccion3->name = "Unidad 3";
                    $CursoSeccion3->visible = 1;
                    $CursoSeccion3->save();
                    
                    $CursoSeccion4 = new MoodleCursoSeccion();
                    $CursoSeccion4->course = $Curso->id;
                    $CursoSeccion4->section = 4;
                    $CursoSeccion4->name = "Unidad 4";
                    $CursoSeccion4->visible = 1;
                    $CursoSeccion4->save();
                    
                    $Context = new MoodleContext();
                    $Context->contextlevel = 50;
                    $Context->instanceid = $Curso->id;
                    $Context->depth = 2;
                    $Context->locked = 0;
                    $Context->save();

                    $Context->path = "/1/".$Context->id;
                    $Context->save(); //xd

                    $explode = explode(" - ", $Curso->idnumber);

                    if (count($explode) > 1) {
                            $curso = trim($explode[0]);
                            $grupo = trim($explode[1]);
                            $grupo = (int)$grupo;

                            $DCurso = DocentesAsignaturas::findFirst("asignatura='{$curso}' AND grupo={$grupo} ");
                            if ($DCurso){
                                $DCurso->context = $Context->id;
                                $DCurso->save();
                            }
                    }
                }
            }
            
    }

    public function moodlePass($password, $algo, array $options = array()){

        if (!defined('PASSWORD_BCRYPT')) define('PASSWORD_BCRYPT', 1);
        if (!defined('PASSWORD_DEFAULT')) define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);
        //define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);

        if (!function_exists('crypt')) {

            trigger_error("Crypt must be loaded for password_hash to function", E_USER_WARNING);

            return null;

        }

        if (!is_string($password)) {

            trigger_error("password_hash(): Password must be a string", E_USER_WARNING);

            return null;

        }

        if (!is_int($algo)) {

            trigger_error("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given", E_USER_WARNING);

            return null;

        }

        switch ($algo) {

            case PASSWORD_BCRYPT:

                $cost = 10;

                if (isset($options['cost'])) {

                    $cost = $options['cost'];

                    if ($cost < 4 || $cost > 31) {

                        trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);

                        return null;

                    }

                }

                $required_salt_len = 22;

                $hash_format = sprintf("$2y$%02d$", $cost);

                break;

            default:

                trigger_error(sprintf("password_hash(): Unknown password hashing algorithm: %s", $algo), E_USER_WARNING);

                return null;

        }

        if (isset($options['salt'])) {

            switch (gettype($options['salt'])) {

                case 'NULL':

                case 'boolean':

                case 'integer':

                case 'double':

                case 'string':

                    $salt = (string) $options['salt'];

                    break;

                case 'object':

                    if (method_exists($options['salt'], '__tostring')) {

                        $salt = (string) $options['salt'];

                        break;

                    }

                case 'array':

                case 'resource':

                default:

                    trigger_error('password_hash(): Non-string salt parameter supplied', E_USER_WARNING);

                    return null;

            }

            if (strlen($salt) < $required_salt_len) {

                trigger_error(sprintf("password_hash(): Provided salt is too short: %d expecting %d", strlen($salt), $required_salt_len), E_USER_WARNING);

                return null;

            } elseif (0 == preg_match('#^[a-zA-Z0-9./]+$#D', $salt)) {

                $salt = str_replace('+', '.', base64_encode($salt));

            }

        } else {

            $buffer = '';

            $raw_length = (int) ($required_salt_len * 3 / 4 + 1);

            $buffer_valid = false;

            if (function_exists('mcrypt_create_iv')) {

                $buffer = mcrypt_create_iv($raw_length, MCRYPT_DEV_URANDOM);

                if ($buffer) {

                    $buffer_valid = true;

                }

            }

            if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {

                $buffer = openssl_random_pseudo_bytes($raw_length);

                if ($buffer) {

                    $buffer_valid = true;

                }

            }

            if (!$buffer_valid && file_exists('/dev/urandom')) {

                $f = @fopen('/dev/urandom', 'r');

                if ($f) {

                    $read = strlen($buffer);

                    while ($read < $raw_length) {

                        $buffer .= fread($f, $raw_length - $read);

                        $read = strlen($buffer);

                    }

                    fclose($f);

                    if ($read >= $raw_length) {

                        $buffer_valid = true;

                    }

                }

            }

            if (!$buffer_valid || strlen($buffer) < $raw_length) {

                $bl = strlen($buffer);

                for ($i = 0; $i < $raw_length; $i++) {

                    if ($i < $bl) {

                        $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));

                    } else {

                        $buffer .= chr(mt_rand(0, 255));

                    }

                }

            }

            $salt = str_replace('+', '.', base64_encode($buffer));



        }

        $salt = substr($salt, 0, $required_salt_len);

        $hash = $hash_format . $salt;

        $ret = crypt($password, $hash);

        if (!is_string($ret) || strlen($ret) <= 13) {

            return false;

        }

        return $ret;
    }
}
