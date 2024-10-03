<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleCategoria extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_course_categories');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'name', new PresenceOfValidator([
                'message' => 'El campo nombre es requerido'
            ]));

        
        $validator->add(
            
            'name', new UniquenessValidator([
                'message' => 'La categoria ya existe'
            ]));
        
    
    
        return $this->validate($validator);
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
