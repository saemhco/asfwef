<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Facultades extends Model {

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
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("facultades");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'codigo', new PresenceOfValidator([
            'message' => 'El código de la facultad es requerido'
        ]));

        $validator = new Validation();

        $validator->add(
                'descripcion', new PresenceOfValidator([
            'message' => 'El nombre de la facultad es requerido'
        ]));

        $validator->add(
                'abreviatura', new PresenceOfValidator([
            'message' => 'El campo abreviatura es requerido'
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
