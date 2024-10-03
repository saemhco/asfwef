<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class AsignaturasSemestreCarreras extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("asignaturas_semestre_carreras");
    }



    public function validation() {
      
    }


    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
