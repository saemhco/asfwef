<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Persona extends Model {

    public function initialize() {
        
        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('personas');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'nombre', new PresenceOfValidator([
            'message' => 'El campo nombre es requerido'
        ])); 
        $validator->add(
            'email', new EmailValidator([
            'message' => 'Debe ser tipo Email'
        ]));
        $validator->add(
            'email', new PresenceOfValidator([
            'message' => 'El campo email es requerido'
        ])); 
        $validator->add(
            'telefono', new PresenceOfValidator([
            'message' => 'El campo telefono es requerido'
        ]));         

        return $this->validate($validator);
    }
    
    public function getMessages($filter = NULL)
    {   
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["".$message->getField()] = '<div class="text-danger errorforms">'.$message->getMessage().'</div>';        
        }
        return $messages;
    }

}
