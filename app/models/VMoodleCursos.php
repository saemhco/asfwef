<?php

use Phalcon\Mvc\Model;

class VMoodleCursos extends Model {

    public function initialize() {
        $this->setSource('view_moodle_asignaturas');
    }


   

}
