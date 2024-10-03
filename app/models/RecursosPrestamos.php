<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class RecursosPrestamos extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("tbl_lib_recursos_prestamos");
    }



    public function validation() {
        $validator = new Validation();

        $validator->add(
            'hora_entrada', new PresenceOfValidator([
                'message' => 'El campo hora de entrada es requerido'
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
