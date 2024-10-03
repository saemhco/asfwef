<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;

class TipoPlanillas extends Model {

    public function initialize() {
        $this->setSource('tbl_per_planillas_tipo');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'codigo', new PresenceOfValidator([
                    'message' => 'El campo codigo de documento es requerido'
        ]));
       
        return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
