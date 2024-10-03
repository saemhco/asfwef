<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Admision extends Model {

    public function initialize() {
        $this->setSource('admision');
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//                'modalidad', new PresenceOfValidator([
//                    'message' => 'El campo modalidad es requerido'
//        ]));
//
//        $validator->add(
//                'fecha_inscripcion', new PresenceOfValidator([
//                    'message' => 'El campo fecha deinscripcion es requerido'
//        ]));
//
//
//        $validator->add(
//                'tipo_inscripcion', new PresenceOfValidator([
//                    'message' => 'El campo tipo de inscripcion es requerido'
//        ]));
//
//        $validator->add(
//                'nro_documento', new PresenceOfValidator([
//                    'message' => 'El campo numero de voucher es requerido'
//        ]));
//
//        $validator->add(
//                'monto', new PresenceOfValidator([
//                    'message' => 'El campo monto es requerido'
//        ]));
//
//        $validator->add(
//                'concepto', new PresenceOfValidator([
//                    'message' => 'El campo concepto es requerido'
//        ]));
//
//        $validator->add(
//                'carrera1', new PresenceOfValidator([
//                    'message' => 'El campo primera opción es requerido'
//        ]));
//
//        $validator->add(
//                'carrera2', new PresenceOfValidator([
//                    'message' => 'El campo segunda opción es requerido'
//        ]));
//
//        $validator->add(
//                'imagen', new PresenceOfValidator([
//                    'message' => 'El campo imagen es requerido'
//        ]));


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
