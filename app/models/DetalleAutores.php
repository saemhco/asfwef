<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class DetalleAutores extends Model
{


    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
    	$this->setSource("detalle_autor");
    }


    public function validation() {
    	$validator = new Validation();

    	/*
    	$validator->add(
    		'descripcion', new PresenceOfValidator([
    			'message' => 'El nombre del programa es requerido'
    		]));

    		*/


//    	$validator->add(
//    		'libro_id', new PresenceOfValidator([
//    			'message' => 'Debe selecionar una facultad'
//    		]));

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
