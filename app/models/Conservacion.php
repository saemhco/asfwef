<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Conservacion extends Model
{

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
