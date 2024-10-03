<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class LibrosReservasWeb extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("tbl_lib_libros_prestamos");
    }



    public function validation() {
        $validator = new Validation();



        $validator->add(
            'fecha_reserva', new PresenceOfValidator([
                'message' => 'El campo fecha entrega es requerido'
            ]));

/*
        $validator->add(
            'fecha_devolucion', new PresenceOfValidator([
                'message' => 'El campo fecha devolucion es requerido'
            ]));
            */
            

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
