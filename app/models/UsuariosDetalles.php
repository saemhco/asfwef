<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class UsuariosDetalles extends Model {

    public function initialize() {
        $this->setSource('tbl_seg_usuarios_detalles');
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//                'id_usuario_detalle', new PresenceOfValidator([
//                    'message' => 'El campo codigo es requerido'
//        ]));


//        $validator->add(
//                'imagen', new PresenceOfValidator([
//                    'message' => 'El campo imagen es requerido'
//        ]));


        return $this->validate($validator);
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
