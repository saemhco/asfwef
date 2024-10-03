<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class AccesoInformacion extends Model {

    public function initialize() {

        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('tbl_web_acceso_informacion');
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
                'informacion', new PresenceOfValidator([
                    'message' => 'El campo reclamo es requerido'
        ]));

        $validator->add(
                'area', new PresenceOfValidator([
                    'message' => 'El campo area es requerido'
        ]));

        $validator->add(
                'medio', new PresenceOfValidator([
                    'message' => 'El campo medio es requerido'
        ]));

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
