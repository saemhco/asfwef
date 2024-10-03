<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class TipoUsuario extends Model {

    public function initialize() {
        
        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('a_codigos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'per_descripcion', new PresenceOfValidator([
            'message' => 'El campo descripcion es requerido'
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
