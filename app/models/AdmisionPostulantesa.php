<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class AdmisionPostulantesa extends Model
{

    public function initialize()
    {
        $this->setSource('admision_postulantes');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'recibo', new PresenceOfValidator([
                'message' => 'El campo recibo es requerido',
            ]));

        $validator->add(
            'monto', new PresenceOfValidator([
                'message' => 'El campo monto es requerido',
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
