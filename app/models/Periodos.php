<?php

use Phalcon\Mvc\Model;


class Periodos extends Model {

    public function initialize() {
        
        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('tbl_per_periodos');
    }

 

}
