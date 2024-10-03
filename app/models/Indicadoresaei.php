<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Indicadoresaei extends Model {

    public function initialize() {
        $this->setSource('tbl_gxi_indicadores_aei');
    }

    public function validation() {

        $validator = new Validation();

        $validator->add(
                'nombre', new PresenceOfValidator([
                    'message' => 'El campo nombre es requerido'
        ]));



        return $this->validate($validator);
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
