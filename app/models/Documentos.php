<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Documentos extends Model
{


    /**
     * ProductTypes initializer
     */
    
    public function initialize() {
    	$this->setSource("tbl_doc_documentos");
    }

    public function validation() {
   	$validator = new Validation();

    //    $validator->add(
    //      'id', new PresenceOfValidator([
    //         'message' => 'Debe selecionar un id'
    //     ]));

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
