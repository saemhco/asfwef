<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleCursoRecurso extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_resource');
    }

}

// idnumber - 1 // - //  docentes_asignaturas 