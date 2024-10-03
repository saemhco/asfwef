<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleAsignaRol extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_role_assignments');
    }

    

}
