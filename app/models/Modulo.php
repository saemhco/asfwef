<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Modulo extends Model {

    public function initialize() {
        $this->setSource('tbl_seg_modulos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'mod_descripcion', new PresenceOfValidator([
            'message' => 'El campo descripcion es requerido'
        ]));
        
        $validator->add(
                'mod_url', new PresenceOfValidator([
            'message' => 'El campo URL es requerido'
        ]));
        
        $validator->add(
                'mod_idmodpadre', new PresenceOfValidator([
            'message' => 'El campo MODULO PADRE es requerido'
        ]));
        
        $validator->add(
                'mod_orden', new PresenceOfValidator([
            'message' => 'El campo ORDEN es requerido'
        ]));

        return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
