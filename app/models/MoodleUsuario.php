<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class MoodleUsuario extends Model {

    public function initialize() {
        $this->setConnectionService('db2');
        $this->setSource('mdl_user');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'firstname', new PresenceOfValidator([
                'message' => 'El campo nombre es requerido'
            ]));

        $validator->add(
            'lastname', new PresenceOfValidator([
                'message' => 'El campo apellido es requerido'
            ]));

         $validator->add(
            'city', new PresenceOfValidator([
                'message' => 'El campo Ciudad es requerido'
            ]));

          $validator->add(
            'address', new PresenceOfValidator([
                'message' => 'El campo Direccion es requerido'
            ]));
        
        $validator->add(
            'email', new PresenceOfValidator([
                'message' => 'El campo email es requerido'
            ]));
        
        $validator->add(
            
            'email', new UniquenessValidator([
                'message' => 'El email de usuario ya esta siendo usado'
            ]));
        
        $validator->add(
            'password', new PresenceOfValidator([
                'message' => 'El campo Clave es requerido'
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
