<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Vistaprestamo extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_prestamos");
    }



    public function validation() {
        $validator = new Validation();

//        $validator->add(
//            'prestamo_id', new PresenceOfValidator([
//                'message' => 'El nombre del lector es requerido'
//            ]));
//
//
//        $validator->add(
//            'fecha_entrega', new PresenceOfValidator([
//                'message' => 'El campo fecha entrega es requerido'
//            ]));
//
//
//        $validator->add(
//            'fecha_devolucion', new PresenceOfValidator([
//                'message' => 'El campo fecha devolucion es requerido'
//            ]));
//            
            

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
