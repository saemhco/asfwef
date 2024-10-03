<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleCurso extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_course');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'fullname', new PresenceOfValidator([
                'message' => 'El campo nombre es requerido'
            ]));

        $validator->add(
            'shortname', new PresenceOfValidator([
                'message' => 'El campo nombre corto es requerido'
            ]));

       
       $validator->add(
            'idnumber', new PresenceOfValidator([
                'message' => 'El campo Codigo es requerido'
            ])); 
        
        $validator->add(
            'category', new PresenceOfValidator([
                'message' => 'El campo Categoria es requerido'
            ])); 
        return $this->validate($validator);
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