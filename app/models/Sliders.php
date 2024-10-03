<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Sliders extends Model {

    public function initialize() {
        $this->setSource('tbl_web_sliders');
    }

    public function validation() {
//        $validator = new Validation();
//
//        $validator->add(
//            'usu_nombre', new PresenceOfValidator([
//                'message' => 'El campo nombre es requerido'
//            ]));
//        
//        $validator->add(
//            'usu_usuario', new PresenceOfValidator([
//                'message' => 'El campo usuario es requerido'
//            ]));
//        
//        $validator->add(
//            
//            'usu_usuario', new UniquenessValidator([
//                'message' => 'El nombre de usuario ya esta siendo usado'
//            ]));
//        
//        $validator->add(
//            'usu_clave', new PresenceOfValidator([
//                'message' => 'El campo Password es requerido'
//            ]));
//        
//        $validator->add(
//            'perfil_id', new PresenceOfValidator([
//                'message' => 'El campo Perfil es requerido'
//            ]));
//
//        return $this->validate($validator);
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
