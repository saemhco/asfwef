<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class PublicoAspefeen extends Model
{

    public function initialize()
    {
        $this->setSource('publico');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'documento', new PresenceOfValidator([
                'message' => 'El campo tipo de documento es requerido',
            ]));

        $validator->add(
            'nro_doc', new PresenceOfValidator([
                'message' => 'El campo número documento es requerido',
            ]));

        $validator->add(
            'nro_doc', new UniquenessValidator([
                'message' => 'El número documento ya esta registrado',
            ]));

        $validator->add(
            'nro_doc', new DigitValidator([
                'message' => 'El campo número documento son solo números',
            ]));

        $validator->add(
            'apellidop', new PresenceOfValidator([
                'message' => 'El campo apellido paterno es requerido',
            ]));

        $validator->add(
            'apellidom', new PresenceOfValidator([
                'message' => 'El campo apellido materno es requerido',
            ]));

        $validator->add(
            'nombres', new PresenceOfValidator([
                'message' => 'El campo nombres es requerido',
            ]));

        $validator->add(
            'email', new EmailValidator([
                'message' => 'El campo email es requerido y debe tener "@"',
            ]));

        $validator->add(
            'email', new UniquenessValidator([
                'message' => 'El email ya esta registrado',
            ]));

        $validator->add(
            'password', new PresenceOfValidator([
                'message' => 'El campo password es requerido',
            ]));

        $validator->add(
            'institucion', new PresenceOfValidator([
                'message' => 'El campo institucion es requerido',
            ]));

        $validator->add(
            'escuela', new PresenceOfValidator([
                'message' => 'El campo escuela es requerido',
            ]));

        $validator->add(
            'categoria', new PresenceOfValidator([
                'message' => 'El campo categoria es requerido',
            ]));

        $validator->add(
            'celular', new PresenceOfValidator([
                'message' => 'El campo celular es requerido',
            ]));

        $validator->add(
            'ciudad', new PresenceOfValidator([
                'message' => 'El campo ciudad es requerido',
            ]));

        $validator->add(
            'tipo_institucion', new PresenceOfValidator([
                'message' => 'El campo tipo de institucion es requerido',
            ]));

        $validator->add(
            'foto', new PresenceOfValidator([
                'message' => 'El campo foto es requerido',
            ]));

        $validator->add(
            'archivo', new PresenceOfValidator([
                'message' => 'El campo archivo es requerido',
            ]));

        $validator->add(
            'archivo_escuela', new PresenceOfValidator([
                'message' => 'El campo archivo escuela es requerido',
            ]));

            
        $validator->add(
            'password', new PresenceOfValidator([
                'message' => 'El campo password es requerido',
            ]));



        return $this->validate($validator);
    }

    public function getMessages()
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
