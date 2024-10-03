<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Grupos extends Model {

    public function initialize() {
        //$this->setSchema('datapoint');
        $this->setSource('tbl_web_grupos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'nombre', new PresenceOfValidator([
                    'message' => 'El campo nombre es requerido'
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
