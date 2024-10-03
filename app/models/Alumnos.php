<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Alumnos extends Model {

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
        $this->setSource("alumnos");
    }

    public function validation() {
        $validator = new Validation();


        $validator->add(
                'nombres', new PresenceOfValidator([
                    'message' => 'El nombre es requerido'
        ]));

        $validator->add(
                'apellidop', new PresenceOfValidator([
                    'message' => 'El apellido paterno es requerido'
        ]));

        $validator->add(
                'apellidom', new PresenceOfValidator([
            'message' => 'El apellido materno es requerido'
        ]));

//        $validator->add(
//                'nro_doc', new PresenceOfValidator([
//            'message' => 'El dni es requerido'
//        ]));

        //return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
