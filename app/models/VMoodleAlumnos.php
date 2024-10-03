<?php

use Phalcon\Mvc\Model;

class VMoodleAlumnos extends Model {

    public function initialize() {
        $this->setSource('view_moodle_alumnos');
    }


   

}
