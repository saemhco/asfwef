<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleContext extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_context');
    }

}

// idnumber - 1 // - //  docentes_asignaturas 