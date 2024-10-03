<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;


class Resoluciones extends Model {

    public function initialize() {
        $this->setSource('tbl_web_resoluciones');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'numero', new PresenceOfValidator([
                    'message' => 'El campo numero es requerido'
        ]));

        $validator->add(
                'titulo', new PresenceOfValidator([
                    'message' => 'El campo titulo es requerido'
        ]));

        $validator->add(
                'tipo', new PresenceOfValidator([
                    'message' => 'El campo tipo es requerido'
        ]));

        //$validator->add(
        //'archivo', new PresenceOfValidator([
        //'message' => 'El campo archivo es requerido'
        //]));

        return $this->validate($validator);
    }

    //paginador


    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
