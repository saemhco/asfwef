<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;

/**
 * Types of Products
 */
class RecuperarColegiados extends Model {

    /**
     * @var integer
     */
    public $codigo;

    /**
     * @var string
     */
    public $nombres;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_cip_colegiados");
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//                'codigo', new PresenceOfValidator([
//                    'message' => 'El campo tipo de codigo es requerido'
//        ]));
//
//        $validator->add(
//                'codigo', new DigitValidator([
//                    'message' => 'El campo codigo son solo números'
//        ]));
//
//        $validator->add(
//                'documento', new PresenceOfValidator([
//                    'message' => 'El campo tipo de documento es requerido'
//        ]));
//
//        $validator->add(
//                'nro_documento', new PresenceOfValidator([
//                    'message' => 'El campo número documento es requerido'
//        ]));
//
//        $validator->add(
//                'nro_documento', new UniquenessValidator([
//                    'message' => 'El número documento ya esta registrado'
//        ]));
//
//        $validator->add(
//                'nro_documento', new DigitValidator([
//                    'message' => 'El campo número documento son solo números'
//        ]));
//
//        $validator->add(
//                'fecha_nacimiento', new PresenceOfValidator([
//                    'message' => 'El campo fecha nacimiento es requerido'
//        ]));
//
//        $validator->add(
//                'fecha_cip', new PresenceOfValidator([
//                    'message' => 'El campo fecha cip es requerido'
//        ]));
//
//
//        $validator->add(
//                'apellido_paterno', new PresenceOfValidator([
//                    'message' => 'El campo apellido paterno es requerido'
//        ]));
//
//        $validator->add(
//                'apellido_materno', new PresenceOfValidator([
//                    'message' => 'El campo apellido materno es requerido'
//        ]));
//
//        $validator->add(
//                'nombres', new PresenceOfValidator([
//                    'message' => 'El campo nombres es requerido'
//        ]));
//
//        $validator->add(
//                'region', new PresenceOfValidator([
//                    'message' => 'El campo region es requerido'
//        ]));
//
//
//        $validator->add(
//                'provincia', new PresenceOfValidator([
//                    'message' => 'El campo provincia es requerido'
//        ]));
//
//        $validator->add(
//                'distrito', new PresenceOfValidator([
//                    'message' => 'El campo distrito es requerido'
//        ]));
//
//        $validator->add(
//                'ubigeo', new PresenceOfValidator([
//                    'message' => 'El campo ubigeo es requerido'
//        ]));
//
//        $validator->add(
//                'especialidad', new PresenceOfValidator([
//                    'message' => 'El campo especialidad es requerido'
//        ]));
//
//        $validator->add(
//                'direccion', new PresenceOfValidator([
//                    'message' => 'El campo direccion es requerido'
//        ]));

//        $validator->add(
//                'ciudad', new PresenceOfValidator([
//                    'message' => 'El campo ciudad es requerido'
//        ]));

//        $validator->add(
//                'sexo', new PresenceOfValidator([
//                    'message' => 'El campo sexo es requerido'
//        ]));
//
//        $validator->add(
//                'seguro', new PresenceOfValidator([
//                    'message' => 'El campo seguro es requerido'
//        ]));

//        $validator->add(
//                'email', new EmailValidator([
//                    'message' => 'El campo email es requerido y debe tener "@"'
//        ]));
//        $validator->add(
//                'email', new UniquenessValidator([
//                    'message' => 'El email ya esta registrado'
//        ]));
//        $validator->add(
//                'celular', new PresenceOfValidator([
//                    'message' => 'El campo celular es requerido'
//        ]));

//        $validator->add(
//                'consejo', new PresenceOfValidator([
//                    'message' => 'El campo consejo es requerido'
//        ]));
//
//        $validator->add(
//                'capitulo', new PresenceOfValidator([
//                    'message' => 'El campo capitulo es requerido'
//        ]));

//        $validator->add(
//                'cv', new PresenceOfValidator([
//                    'message' => 'El campo cv es requerido'
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
