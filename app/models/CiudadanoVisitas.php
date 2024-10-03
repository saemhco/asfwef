<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;


class CiudadanoVisitas extends Model {

    public function initialize() {
        $this->setSource('publico');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'documento', new PresenceOfValidator([
                    'message' => 'El campo tipo de documento es requerido'
        ]));

        $validator->add(
                'nro_doc', new PresenceOfValidator([
                    'message' => 'El campo número documento es requerido'
        ]));

        $validator->add(
                'nro_doc', new UniquenessValidator([
                    'message' => 'El número documento ya esta registrado'
        ]));

        $validator->add(
                'nro_doc', new DigitValidator([
                    'message' => 'El campo número documento son solo números'
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
