<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Caja extends Model
{
 /**
     * @var integer
     */
 public $codigo;

    /**
     * @var string
     */
    public $voucher;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("caja");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'voucher', new PresenceOfValidator([
                'message' => 'El numero del voucher es requerido'
            ]));


//        $validator->add(
//            'nacionalidad', new PresenceOfValidator([
//                'message' => 'La nacionalidad del autor es requerido'
//            ]));

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
