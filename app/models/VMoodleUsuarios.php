
<?php

use Phalcon\Mvc\Model;

class VMoodleUsuarios extends Model {

    public function initialize() {
        $this->setSource('view_moodle_alumnos_docentes');
    }


   

}

