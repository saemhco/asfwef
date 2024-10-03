<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Curriculas extends Model
{
 /**
     * @var integer
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
        $this->setSource("curriculas");
    }

    public function validation() {
        $validator = new Validation();





        return $this->validate($validator);
    }

    /*
    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }*/
}
