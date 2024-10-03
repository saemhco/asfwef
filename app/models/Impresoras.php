<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Impresoras extends Model {

    /**
     * @var integer
     */
    public $modelo;

    /**
     * @var string
     */
    public $marca;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_eqp_impresoras");
    }

    public function validation() {
        $validator = new Validation();


//        $validator->add(
//                'modelo', new PresenceOfValidator([
//            'message' => 'El modelo es requerido'
//        ]));
//
//        $validator->add(
//                'color', new PresenceOfValidator([
//            'message' => 'El color es requerido'
//        ]));
//
//        $validator->add(
//                'serie', new PresenceOfValidator([
//            'message' => 'La serie es requerido'
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
