<?php

/*
  By Spiderman
 */

class Datatables {

    protected $_di;
    private $columnaId;
    private $sqlSelect;
    private $sqlFrom;
    private $sqlWhere;
    private $sqlGroupBy;
    private $sqlHaving;
    private $sqlOrderBy;
    private $params;
    private $database;

    //private $database;
    //creamos y llamamos la variable database -> public function __construct($di,$database)
    public function __construct($di, $database = NULL) {
        $this->_di = $di;
        if ($database) {

            $this->database = $database;
        } else {
            $this->database = "db";
        }
    }

    public function setColumnaId($columnaId) {
        $this->columnaId = $columnaId;
    }

    public function setSelect($sql) {
        $this->sqlSelect = $sql;
    }

    public function setFrom($sql) {
        $this->sqlFrom = $sql;
    }

    public function setWhere($sql) {
        $this->sqlWhere = $sql;
    }

    public function setGroupBy($sql) {
        $this->sqlGroupBy = $sql;
    }

    public function setHaving($sql) {
        $this->sqlHaving = $sql;
    }

    public function setOrderBy($sql) {
        $this->sqlOrderBy = $sql;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function getJson() {
        //llamamos a datatabase
        $db = $this->_di->get($this->database);

        //$db = $this->_di->get("db");
        $params = $this->params;
        
        $draw = $params['draw'];
        $columns = $params['columns'];
        $start = $params['start'];
        $length = $params['length'];
        $search = $params['search']['value'];

        $where_and = array();
        if (strlen(trim($this->sqlWhere)) > 0) {
            $where_and[] = $this->sqlWhere;
        }
        if ($search != '') {
            $where_or = array();
            foreach ($columns as $column) {
                if ($column['searchable'] == "true" && $column['name'] != '') {
                    if ($this->database == "db2") {
                        $where_or[] = " {$column['name']} LIKE '%$search%' ";
                    } else {
                        $where_or[] = " unaccent(CAST ({$column['name']} AS TEXT ))  ILIKE unaccent('%$search%') ";
                    }
                }
            }
            if (count($where_or) > 0) {
                $where_and[] = '(' . implode(' or ', $where_or) . ')';
            }
        }
        $where = '';
        if (count($where_and) > 0) {
            $where = " WHERE " . implode(' and ', $where_and);
        }

        $groupby = "";
        if (strlen(trim($this->sqlGroupBy)) > 0) {
            $groupby = " GROUP BY " . $this->sqlGroupBy;
        }

        $having = "";
        if (strlen(trim($this->sqlHaving)) > 0) {
            $having = " HAVING " . $this->sqlHaving;
        }

        $orderby = array();
        if (strlen(trim($this->sqlOrderBy)) > 0) {
            $orderby[] = $this->sqlOrderBy;
        }
        if (isset($params['order'])) {
            foreach ($params['order'] as $order) {
                $orderby[] = $columns[$order['column']]['name'] . ' ' . $order['dir'];
            }
        }
        $orderby = (count($orderby) > 0) ? " ORDER BY " . implode(',', $orderby) : '';

        $sqlCount = "SELECT count($this->columnaId) as cantidad FROM {$this->sqlFrom} $where $groupby $having";

      

            //$limitInicial=($this->_page-1  ) *  ($this->_nroitems) ; // limite de bvusqueda 9-18-27 de 9 en 9 9-0 9-9-9-18
           // $limiteFInal= ( ( $this->_page-1 ) * $this->_nroitems ) ;
           // $query      = $query2 . " LIMIT $this->_nroitems  offset     $limitInicial ";
        


        $limit_offset = '';
        if ($length != -1) {
            $limit_offset = "LIMIT $length OFFSET $start";
        }
        $sql = "SELECT {$this->columnaId} as pk, {$this->sqlSelect} FROM {$this->sqlFrom} $where $groupby $having $orderby $limit_offset";

        //die($length);
        //die($sqlCount);
        //die($sql);
        $error = '';
        $resultados = array();
        try {
            $recordsTotal = $db->fetchOne($sqlCount, Phalcon\Db::FETCH_ASSOC);
            $resultados = $db->fetchAll($sql, Phalcon\Db::FETCH_ASSOC);
        } catch (Exception $ex) {
            $error = $ex->getMessage();
        }

        $recordsTotal = $recordsTotal['cantidad'];

        $return = array();
        $return['draw'] = $draw;
        $return['recordsTotal'] = $recordsTotal;
        $return['recordsFiltered'] = $recordsTotal;
        $data = array();
        $item = $start;
        foreach ($resultados as $i => $resultado) {
            $item++;
            $DT_RowId = array_shift($resultado);

            //echo '<pre>';
            //print_r($resultado);
            //exit();

            $data[$i] = $resultado;
            $data[$i]['item'] = $item;
            $data[$i]['actions'] = '<center><label class="checkbox"><input type="radio" name="selrow" class="selrow" value="' . $DT_RowId . '"  ><i></i> </label></center>';
            $data[$i]['DT_RowId'] = $DT_RowId;
//            $data[$i]['DT_RowClass'] = 'success';
        }
        if ($error != '') {
            $return['error'] = $error;
        } else {
            $return['data'] = $data;
        }
        //echo "<pre>";print_r($return);
        echo json_encode($return);
    }

}
