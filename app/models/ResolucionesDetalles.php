<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class ResolucionesDetalles extends Model {

    public function initialize() {
        $this->setSource('tbl_web_resoluciones_detalles');
    }

    public function validation() {
        $validator = new Validation();

        // $validator->add(
        //         'tipo', new PresenceOfValidator([
        //             'message' => 'El campo tipo es requerido'
        // ]));



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
