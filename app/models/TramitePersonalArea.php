<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class TramitePersonalArea extends Model {

    public function initialize() {
        $this->setSource('tbl_doc_personal_areas');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'personal', new PresenceOfValidator([
                    'message' => 'El campo personal es requerido'
        ]));

        $validator->add(
                'area', new PresenceOfValidator([
                    'message' => 'El campo area es requerido'
        ]));

        $validator->add(
                'perfil', new PresenceOfValidator([
                    'message' => 'El campo perfil es requerido'
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
