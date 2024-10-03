<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class TipoPantallas extends Model {

    public function initialize() {
        $this->setSource('a_codigos');
    }

    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//                'titular', new PresenceOfValidator([
//                    'message' => 'El campo titular es requerido'
//        ]));
//        $validator->add(
//                'fecha_hora', new PresenceOfValidator([
//                    'message' => 'El campo fecha es requerido'
//        ]));
//
//        $validator->add(
//                'texto_muestra', new PresenceOfValidator([
//                    'message' => 'El campo texto muestra es requerido'
//        ]));
//
//        $validator->add(
//                'texto_complementario', new PresenceOfValidator([
//                    'message' => 'El campo texto complementario es requerido'
//        ]));
//
//        $validator->add(
//                'imagen', new PresenceOfValidator([
//                    'message' => 'El campo imagen es requerido'
//        ]));
//
//
//        return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
