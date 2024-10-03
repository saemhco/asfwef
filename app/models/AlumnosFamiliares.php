<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class AlumnosFamiliares extends Model {

    /**
     * @var integer
     */
    public $autor_id;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("alumnos_familiares");
    }

    public function validation() {
        $validator = new Validation();


        $validator->add(
                'documento', new PresenceOfValidator([
                    'message' => 'El campo es requerido'
        ]));


        $validator->add(
                'parentesco', new PresenceOfValidator([
                    'message' => 'El campo es requerido'
        ]));




        $validator->add(
                'grado_instruccion', new PresenceOfValidator([
                    'message' => 'El campo es requerido'
        ]));

        $validator->add(
                'sexo', new PresenceOfValidator([
                    'message' => 'El campo es requerido'
        ]));

        $validator->add(
                'estado_civil', new PresenceOfValidator([
                    'message' => 'El campo es requerido'
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
