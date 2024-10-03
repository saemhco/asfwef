<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Regimendocentes extends Model {

    /**
     * @var string
     */
    public $numero;

    /**
     * @var string
     */
    public $codigo;

    /**
     * @var string
     */
    public $descripcion;

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
        $this->setSource("a_codigos");
    }

    public function validation() {
//    	$validator = new Validation();
//
//        $validator->add(
//            'codigo', new PresenceOfValidator([
//                'message' => 'El codigo del Programa es requerido'
//            ]));
//
//
//        $validator->add(
//            'descripcion', new PresenceOfValidator([
//                'message' => 'El nombre del Programa es requerido'
//            ]));
//
//
//        $validator->add(
//          'facultad', new PresenceOfValidator([
//             'message' => 'Debe selecionar una facultad'
//         ]));
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
