<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Formatos extends Model {

    public function initialize() {
        $this->setSource('tbl_lic_formatos');
    }

    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//                'titulo', new PresenceOfValidator([
//                    'message' => 'El campo titular es requerido'
//        ]));
//
//        return $this->validate($validator);
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
