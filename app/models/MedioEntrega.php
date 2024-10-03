<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class MedioEntrega extends Model
{
    

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("a_codigos");
    }
    
     public function validation() {
        $validator = new Validation();

        $validator->add(
            'nombre', new PresenceOfValidator([
                'message' => 'El nombre es requerido'
            ]));


        
        return $this->validate($validator);
    }

    public function getMessages($filter=NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
