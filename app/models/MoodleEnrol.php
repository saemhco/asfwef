<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleEnrol extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_enrol');
    }

   
    public function getMessages($filter=NULL)
    {
        $messages = [];
        foreach (parent::getMessages() as $message){
            $messages["".$message->getField()] = '<div class="text-danger errorforms">'.$message->getMessage().'</div>';        
        }
        return $messages;
    }

}

// idnumber - 1 // - //  docentes_asignaturas 