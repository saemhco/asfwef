<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleCursoModulo extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_course_modules');
    }

}

// idnumber - 1 // - //  docentes_asignaturas 