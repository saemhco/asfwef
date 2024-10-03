<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Visitas extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_web_visitas');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'id_visitante',
            new PresenceOfValidator([
                'message' => 'El campo vistante es requerido'
            ])
        );

        $validator->add(
            'id_personal',
            new PresenceOfValidator([
                'message' => 'El campo personal es requerido'
            ])
        );

        $validator->add(
            'id_area',
            new PresenceOfValidator([
                'message' => 'El campo area es requerido'
            ])
        );


        return $this->validate($validator);
    }

    public function getMessages()
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
