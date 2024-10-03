<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Locales extends Model {

    public function initialize() {
        $this->setSource('tbl_web_locales');
    }

    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//            'nombre', new PresenceOfValidator([
//                'message' => 'El campo nombre es requerido'
//            ]));
//        
//        $validator->add(
//            'url', new PresenceOfValidator([
//                'message' => 'El campo url es requerido'
//            ]));
//        
//        return $this->validate($validator);
    }
    
    public function getMessages($filter=NULL)
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["".$message->getField()] = '<div class="text-danger errorforms">'.$message->getMessage().'</div>';        
        }
        return $messages;
    }

}
