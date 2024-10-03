<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
//use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class TablaDestino extends Model {

    public function initialize() {
        //$this->setSource('tbl_web_publico_experiencia');
    }

    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//                'codigo', new PresenceOfValidator([
//                    'message' => 'El campo codigo es requerido'
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
