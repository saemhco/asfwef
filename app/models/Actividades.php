<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Actividades extends Model {

    public function initialize() {
        //$this->setSchema('datapoint');
        $this->setSource('tbl_doc_actividades');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'fecha', new PresenceOfValidator([
                    'message' => 'El campo número de fecha es requerido'
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
