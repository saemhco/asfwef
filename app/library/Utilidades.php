<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Utilidades extends Component
{

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu($idpadre, $perid)
    {




        //print $idpadre."---".$perfil;exit();
        // print $perfil;exit();
        $db = $this->db;
        //$perid = (int)$perfil;

        $sql = 'SELECT modu.id as id,modu.mod_descripcion as descripcion,modu.mod_url as modurl,
       modu.mod_idmodpadre,modu.mod_icono 
       FROM public.tbl_seg_modulos_perfiles as keyperm
       INNER JOIN public.tbl_seg_modulos as modu ON keyperm.modulo_id = modu.id
       INNER JOIN public.tbl_seg_perfiles as per ON per.id = keyperm.perfil_id
       WHERE keyperm.perfil_id = ' . $perid . ' AND  modu.estado = ' . "'A'" . ' AND keyperm.estado = ' . "'A'" . ' AND modu.mod_idmodpadre = ' . $idpadre . ' 
        ORDER BY modu.mod_orden ASC  ';
        $resultados = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);


        $sql2 = "SELECT modu.mod_idmodpadre as id
        FROM public.tbl_seg_modulos as modu
        WHERE modu.mod_url= '" . $controllerName . "'";
        $res = $db->fetchOne($sql2, Phalcon\Db::FETCH_OBJ);

        //echo '<pre>';
        //print_r($resultados);
        //exit();

        $html = "";
        $idController = $res->id;
        foreach ($resultados as $o) {
            $controllerName = substr($_SERVER["REQUEST_URI"], 1, strlen($_SERVER["REQUEST_URI"])-1);

            if ($o->modurl == "#") {
                if ($idController == $o->id) {
                    $html .= "<li class='open'>";
                } else {
                    $html .= "<li>";
                }
                $html .= "<a href='#'><i class='fa fa-lg fa-fw " . $o->mod_icono . "'></i> <span class='menu-item-parent' >" . ucfirst(strtolower($o->descripcion)) . "</span></a>";
                if ($idController == $o->id) {
                    $html .= "<ul style='display: block;'>";
                } else {
                    $html .= "<ul >";
                }
                $html .= $this->getMenu($o->id, $perid);
                $html .= "</ul>";
                $html .= "</li>";
            } else {
                if ($controllerName == "panel") {
                    $html .= "<li>";
                    $arrParsedUrl = parse_url($o->modurl);
                    if ($arrParsedUrl['scheme'] === "http" || $arrParsedUrl['scheme'] === "https") {
                        $html .= "<a target='_blank' href='" . ($o->modurl) . "'> " . '<span class="menu-item-parent">' . ucfirst(strtolower($o->descripcion)) . "</span></a>";
                    } else {
                        $html .= "<a href='" . $this->url->getBaseUri() . strtolower($o->modurl) . "'>" . '<span class="menu-item-parent">' . ucfirst(strtolower($o->descripcion)) . "</span></a>";
                    }
                    $html .= "</li>";
                } else {
                    if ($controllerName == $o->modurl) {
                        $html .= "<li class='active'>";
                    } else {
                        $html .= "<li>";
                    }
                    $arrParsedUrl = parse_url($o->modurl);
                    if ($arrParsedUrl['scheme'] === "http" || $arrParsedUrl['scheme'] === "https") {
                        $html .= "<a target='blank' href='" . strtolower($o->modurl) . "'> " . '<span class="menu-item-parent">' . ucfirst(strtolower($o->descripcion)) . "</span></a>";
                    } else {
                        $html .= "<a href='" . $this->url->getBaseUri() . strtolower($o->modurl) . "'>" . '<span class="menu-item-parent">' . ucfirst(strtolower($o->descripcion)) . "</span></a>";
                    }
                    $html .= "</li>";
                }
            }
        }
        return $html;
    }
    function contains($needle, $haystack)
    {
        return strpos($haystack, $needle) !== false;
    }
    //Biblio
    public function count_libros($key, $value)
    {
        $db = $this->db;
        //$perid = (int)$perfil;



        $sql = " SELECT COUNT(id_libro) as total FROM tbl_lib_libros WHERE estado = 'A' AND " . $key . " = '" . $value . "'";
        //print $sql; exit();
        $resultados = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        return $resultados->total;
    }

    //Bolsa
    public function count_empleos($key, $value)
    {
        $db = $this->db;
        //$perid = (int)$perfil;

        $fecha_actual = date("Y-m-d");
        $sql = " SELECT COUNT(id_empleo) as total FROM tbl_btr_empleos WHERE estado = 'A' AND " . $key . " = '" . $value . "' AND fecha_clausura >= '$fecha_actual' ";
        //print $sql; exit();
        $resultados = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        return $resultados->total;
    }

    public function url_search($full_url, $word, $value)
    {
        $pos = strpos($full_url, $word);
        if ($pos === false) {
            $posx = strpos($full_url, "?");
            if ($posx === false) {
                $new_url = $full_url . "?" . $word . "=" . $value;
            } else {
                $new_url = $full_url . "&" . $word . "=" . $value;
            }
        } else {
            $cadena = $full_url;
            $patron = '/' . $word . '=([0-9]*)/';
            $sustitucion = $word . "=" . $value;
            $new_url = preg_replace($patron, $sustitucion, $cadena);
        }

        return $new_url;
    }



    public function partedescripcion($campo, $inicio, $fin)
    {
        $descripcion = mb_substr($campo, $inicio, $fin);
        return $descripcion;
    }

    public function fechita($fecha, $format)
    {
        $fecha_envio = date($format, strtotime($fecha));

        //print_r($fecha_envio);
        //exit();
        return $fecha_envio;
    }

    public function hora_formato($fecha)
    {

        //print($fecha);
        //exit(); 

        //$hora_actual_envio = date('h:i:s A');
        $fecha_formato_1 = explode(" ", $fecha);

        //print($fecha_formato_1[1]);
        //exit();

        $hora = date("g:i A", strtotime($fecha_formato_1[1]));

        //print($hora);
        //exit();

        return $hora;
    }

    public function hora_peru($hora)
    {
        // print($hora);
        // exit();
        $hora = date("g:i A", strtotime($hora));
        return $hora;
    }

    public function hora($hora, $format)
    {
        $hora_envio = date($format, strtotime($hora));
        return $hora_envio;
    }

    public function truco($fecha)
    {
        $fecha_envio = explode(" ", $fecha);
        return $fecha_envio[0];
    }
}
