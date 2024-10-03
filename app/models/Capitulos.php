<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
//subiendo
/**
 * Types of Products
 */
class Capitulos extends Model {

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
    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_cip_capitulos");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'descripcion', new PresenceOfValidator([
            'message' => 'La descripcion es requerida'
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
