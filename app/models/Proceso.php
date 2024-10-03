<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Proceso extends Model {

    public function initialize() {
        
        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('tbl_seg_procesos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'descripcion', new PresenceOfValidator([
            'message' => 'El campo descripcion es requerido'
        ]));      
        
        $validator->add(
            'proceso', new PresenceOfValidator([
            'message' => 'El campo proceso es requerido'
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
