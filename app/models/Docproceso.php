<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Docproceso extends Model {

    public function initialize() {
        $this->setSource('tbl_web_docprocesos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'fecha_hora', new PresenceOfValidator([
                    'message' => 'El campo fecha enlace es requerido'
        ]));

        // $validator->add(
        //         'referencia', new PresenceOfValidator([
        //             'message' => 'El campo descripcion es requerido'
        // ]));

        // $validator->add(
        //         'referencia_enlace', new PresenceOfValidator([
        //             'message' => 'El campo referencia enlace es requerido'
        // ]));



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
