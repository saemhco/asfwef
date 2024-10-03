<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleUserEnrol extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_user_enrolments');
    }

   
  

}

// idnumber - 1 // - //  docentes_asignaturas 