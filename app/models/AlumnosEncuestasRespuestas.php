<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class AlumnosEncuestasRespuestas extends Model
{
    /**
     * @var integer
     */
    public $tc_id;

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
    public function initialize()
    {
        $this->setSource("alumnos_encuestas_respuestas");
    }
    
    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//                'descripcion', new PresenceOfValidator([
//            'message' => 'El campo descripcion es requerido'
//        ]));
//
//        return $this->validate($validator);
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
