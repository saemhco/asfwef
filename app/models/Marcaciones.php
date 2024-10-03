<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Marcaciones extends Model {

    public function initialize() {
        $this->setSource('tbl_web_marcaciones');
    }

}
