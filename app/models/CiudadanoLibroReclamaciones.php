<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;

class CiudadanoLibroReclamaciones extends Model {

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


        $validator->add(
                'apellidop', new PresenceOfValidator([
                    'message' => 'El campo apellido paterno es requerido'
        ]));

        $validator->add(
                'apellidom', new PresenceOfValidator([
                    'message' => 'El campo apellido materno es requerido'
        ]));

        $validator->add(
                'nombres', new PresenceOfValidator([
                    'message' => 'El campo nombres es requerido'
        ]));

        $validator->add(
                'region', new PresenceOfValidator([
                    'message' => 'El campo region es requerido'
        ]));

        $validator->add(
                'provincia', new PresenceOfValidator([
                    'message' => 'El campo provincia es requerido'
        ]));

        $validator->add(
                'distrito', new PresenceOfValidator([
                    'message' => 'El campo distrito es requerido'
        ]));

        $validator->add(
                'ubigeo', new PresenceOfValidator([
                    'message' => 'El campo ubigeo es requerido'
        ]));

        $validator->add(
                'direccion', new PresenceOfValidator([
                    'message' => 'El campo direccion es requerido'
        ]));

        $validator->add(
                'ciudad', new PresenceOfValidator([
                    'message' => 'El campo ciudad es requerido'
        ]));

        $validator->add(
                'sexo', new PresenceOfValidator([
                    'message' => 'El campo sexo es requerido'
        ]));

        $validator->add(
                'email', new EmailValidator([
                    'message' => 'El campo email es requerido y debe tener "@"'
        ]));


        $validator->add(
                'email', new UniquenessValidator([
                    'message' => 'El email ya esta registrado'
        ]));

        $validator->add(
                'celular', new PresenceOfValidator([
                    'message' => 'El campo celular es requerido'
        ]));

        $validator->add(
                'password', new PresenceOfValidator([
                    'message' => 'El campo password es requerido'
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
