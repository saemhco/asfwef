
<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Indicadores extends Model {

    public function initialize() {
        $this->setSource('tbl_lic_indicadores');
    }

    public function validation() {
       
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}

