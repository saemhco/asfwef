<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;


class VPersonalArea extends Model {

    public function initialize() {
        $this->setSource('view_personal_area');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'id_personal', new PresenceOfValidator([
                    'message' => 'El campo numero es requerido'
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
