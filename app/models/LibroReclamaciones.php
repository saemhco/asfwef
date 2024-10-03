<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class LibroReclamaciones extends Model {

    public function initialize() {

        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('tbl_web_libro_reclamaciones');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'tipo', new PresenceOfValidator([
                    'message' => 'El campo tipo es requerido'
        ]));

        $validator->add(
                'codigo', new PresenceOfValidator([
                    'message' => 'El campo codigo es requerido'
        ]));

        $validator->add(
                'reclamo', new PresenceOfValidator([
                    'message' => 'El campo reclamo es requerido'
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
