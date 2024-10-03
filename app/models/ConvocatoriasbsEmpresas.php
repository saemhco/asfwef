<?php

use Phalcon\Mvc\Model;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class ConvocatoriasbsEmpresas extends Model {

    public function initialize() {
        $this->setSource('tbl_web_convocatorias_bs_empresas');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'anexos', new PresenceOfValidator([
                    'message' => 'Adjuntar anexos es obligatorio'
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
