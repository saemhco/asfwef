<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class PublicoReconocimientos extends Model {

    public function initialize() {
        $this->setSource('tbl_web_publico_reconocimientos');
    }

    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//                'id_personal', new PresenceOfValidator([
//                    'message' => 'El campo personal es requerido'
//        ]));
//
//        $validator->add(
//                'cargo', new PresenceOfValidator([
//                    'message' => 'El campo cargo es requerido'
//        ]));
//
//        $validator->add(
//                'oficina', new PresenceOfValidator([
//                    'message' => 'El campo oficina es requerido'
//        ]));
//
//
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
