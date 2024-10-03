<?php

use Phalcon\Mvc\Model;

class Permiso extends Model {

    public function initialize() {
        $this->setSource('tbl_seg_modulos_perfiles');
    } 
    
}