<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class EventosArchivos extends Model {

    public function initialize() {
        $this->setSource('tbl_web_eventos_archivos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'titular', new PresenceOfValidator([
                    'message' => 'El campo titular es requerido'
        ]));

        $validator->add(
                'fecha_hora', new PresenceOfValidator([
                    'message' => 'El campo fecha es requerido'
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
