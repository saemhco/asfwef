<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;

class AdmisionPostulantes extends Model {

    public function initialize() {
        $this->setSource('admision_postulantes');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'fecha_inscripcion', new PresenceOfValidator([
                    'message' => 'El campo fecha deinscripcion es requerido'
        ]));


        $validator->add(
                'carrera1', new PresenceOfValidator([
                    'message' => 'El campo primera opción es requerido'
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
