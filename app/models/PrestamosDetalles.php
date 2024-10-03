<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class PrestamosDetalles extends Model
{


    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
    	$this->setSource("tbl_lib_libros_prestamos_detalles");
    }


    public function validation() {
       
    }

    public function getMessages() {
    	$messages = [];
    	foreach (parent::getMessages() as $message) {
    		$messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
    	}
    	return $messages;
    }




}
