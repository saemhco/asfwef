<?php
class ProcesosgestionpersonalController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/procesosgestionpersonal.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function saveRegistrarPersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            //$fechaDesde = date('Y-m-d');

            //$date = date("d-m-Y");
            //Incrementando 2 dias
            //$mod_date = strtotime($date . "+ 2 days");
            //echo date("d-m-Y", $mod_date) . "\n"; 
            //$fechaHasta = $mod_date;

            //18,19,20,21,22

            $f_d = $this->request->getPost("fecha_desde", "string");
            $f_h = $this->request->getPost("fecha_hasta", "string");


            $fechaDesde = new DateTime($f_d);
            $fechaHasta = new DateTime($f_h);




            
            // Necesitamos modificar la fecha final en 1 día para que aparezca en el bucle
            $fechaHasta = $fechaHasta->modify('+1 day');

            $intervalo = DateInterval::createFromDateString('1 day');
            $periodo = new DatePeriod($fechaDesde, $intervalo, $fechaHasta);

            foreach ($periodo as $dt) {
                //echo $dt->format("Y-m-d\n");
                $fechaPeriodo = $dt->format("Y-m-d");

                $personal = Personal::find("estado = 'A'");
                foreach ($personal as $personalActivo) {
                    //echo '<pre>';
                    //print_r($personalActivo->codigo."\n");
                    //$marcaciones = Marcaciones::find("id_personal = $personalActivo->codigo AND fecha_hora = $fechaPeriodo");

                    $db = $this->db;
                    $mSql = "SELECT *
                    FROM tbl_web_marcaciones
                    WHERE CAST(fecha_hora AS DATE) = '$fechaPeriodo' ORDER BY id_personal ASC";
                    $marcaciones = $db->fetchAll($mSql, Phalcon\Db::FETCH_OBJ);

                    foreach ($marcaciones as $marcacionValue) {
                        //echo '<pre>';
                        //print_r($marcacionValue->id_personal . "\n");

                        $separar = (explode(" ", $marcacionValue->fecha_hora));
                        $fechaMarcacion = $separar[0];
                        $horaMarcacion = $separar[1];


                        $db2 = $this->db;
                        $pmSql = "SELECT *
                        FROM tbl_web_personal_marcaciones
                        WHERE CAST(fecha AS DATE) = '$fechaMarcacion' AND id_personal = $marcacionValue->id_personal ORDER BY id_personal ASC";



                        $pm = $db2->fetchOne($pmSql, Phalcon\Db::FETCH_OBJ);

                        if ($pm) {
                            //print("No inserta");
                            //exit();
                        } else {

                            $db3 = $this->db;
                            $pmInsert = " INSERT INTO tbl_web_personal_marcaciones (id_personal_marcacion, id_personal, fecha, estado) "
                                . "VALUES (default,$marcacionValue->id_personal,'$fechaMarcacion','A')";
                            $db3->fetchOne($pmInsert, Phalcon\Db::FETCH_OBJ);
                        }





                        // print($horaMarcacion);
                        // exit();

                        if (strtotime($horaMarcacion) > strtotime("04:00:00") && strtotime($horaMarcacion) <= strtotime("10:00:00")) {

                            $db4 = $this->db;
                            $pmUpdate = "UPDATE tbl_web_personal_marcaciones 
                            SET horario_ingreso_1 = '$horaMarcacion',
                            ingreso_1 = $marcacionValue->id_marcacion 
                            WHERE
                                tbl_web_personal_marcaciones.fecha = '$fechaMarcacion' 
                                AND tbl_web_personal_marcaciones.id_personal = $marcacionValue->id_personal";
                            $db4->fetchOne($pmUpdate, Phalcon\Db::FETCH_OBJ);


                            // print("Exito");
                            // exit();


                        } 
                        
                        if (strtotime($horaMarcacion) > strtotime("10:00:00") && strtotime($horaMarcacion) <= strtotime("13:45:00")) {

                            $db4 = $this->db;
                            $pmUpdate = "UPDATE tbl_web_personal_marcaciones 
                            SET horario_salida_1 = '$horaMarcacion',
                            salida_1 = $marcacionValue->id_marcacion 
                            WHERE
                                tbl_web_personal_marcaciones.fecha = '$fechaMarcacion' 
                                AND tbl_web_personal_marcaciones.id_personal = $marcacionValue->id_personal";
                            $db4->fetchOne($pmUpdate, Phalcon\Db::FETCH_OBJ);
                        } 
                        
                        if (strtotime($horaMarcacion) > strtotime("13:45:00") && strtotime($horaMarcacion) <= strtotime("15:30:00")) {

                            $db4 = $this->db;
                            $pmUpdate = "UPDATE tbl_web_personal_marcaciones 
                            SET horario_ingreso_2 = '$horaMarcacion',
                            ingreso_2 = $marcacionValue->id_marcacion 
                            WHERE
                                tbl_web_personal_marcaciones.fecha = '$fechaMarcacion' 
                                AND tbl_web_personal_marcaciones.id_personal = $marcacionValue->id_personal";
                            $db4->fetchOne($pmUpdate, Phalcon\Db::FETCH_OBJ);
                        } 
                        
                        if (strtotime($horaMarcacion) > strtotime("15:30:00")) {

                            $db4 = $this->db;
                            $pmUpdate = "UPDATE tbl_web_personal_marcaciones 
                            SET horario_salida_2 = '$horaMarcacion',
                            salida_2 = $marcacionValue->id_marcacion 
                            WHERE
                                tbl_web_personal_marcaciones.fecha = '$fechaMarcacion' 
                                AND tbl_web_personal_marcaciones.id_personal = $marcacionValue->id_personal";
                            $db4->fetchOne($pmUpdate, Phalcon\Db::FETCH_OBJ);
                        }
                    }
                    //exit();
                }
                //exit();
            }

            //exit();

            if ($periodo) {
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

    public function datatableAction($fecha_inicio = null, $fecha_fin = null)
    {

        if ($fecha_inicio != 0 and $fecha_fin != 0) {
            $where = "AND (CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else if ($fecha_inicio != 0 and $fecha_fin != 0) {
            $where = "AND (CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else {
            $where = "";
        }


        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal_marcacion");
            $datatable->setSelect("id_personal_marcacion,id_personal,fecha_format,fecha,personal,ingreso_1, salida_1, ingreso_2, salida_2, horario_ingreso_1, horario_salida_1, horario_ingreso_2, horario_salida_2, estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_personal_marcaciones.id_personal_marcacion,
            public.tbl_web_personal_marcaciones.id_personal,
            to_char( PUBLIC.tbl_web_personal_marcaciones.fecha, 'DD/MM/YYYY' ) AS fecha_format,
            PUBLIC.tbl_web_personal_marcaciones.fecha,
             CONCAT (public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal,
            public.tbl_web_personal_marcaciones.ingreso_1,
            public.tbl_web_personal_marcaciones.salida_1,
            public.tbl_web_personal_marcaciones.ingreso_2,
            public.tbl_web_personal_marcaciones.salida_2,
            public.tbl_web_personal_marcaciones.horario_ingreso_1,
            public.tbl_web_personal_marcaciones.horario_salida_1,
            public.tbl_web_personal_marcaciones.horario_ingreso_2,
            public.tbl_web_personal_marcaciones.horario_salida_2,
            public.tbl_web_personal_marcaciones.estado
            FROM
            public.tbl_web_personal_marcaciones
            INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_marcaciones.id_personal 
            WHERE
            public.tbl_web_personal_marcaciones.estado = 'A' $where ORDER BY public.tbl_web_personal_marcaciones.fecha DESC) AS temporal_table");
            //$datatable->setWhere("$where");
            $datatable->setOrderBy("fecha desc");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    
    }
}
