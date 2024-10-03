<?php

use Phalcon\Mvc\Model;

class Procesousuario extends Model {

    public function initialize() {
        $this->setSource('tbl_seg_procesos_usuarios');
    } 
    
}