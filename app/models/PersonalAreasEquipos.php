<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class PersonalAreasEquipos extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_web_personal_areas_equipos');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'id_tabla', new PresenceOfValidator([
                'message' => 'Debe seleccionar una opcion',
            ]));

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
