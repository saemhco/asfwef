<?php

use Phalcon\Mvc\Model;

class VMoodleCategorias extends Model {

    public function initialize() {
        $this->setSource('view_moodle_asignaturas_categorias');
    }


   

}
