<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;


class Galerias extends Model {

    public function initialize() {
        $this->setSource('tbl_web_galerias');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'titular', new PresenceOfValidator([
                    'message' => 'El campo titular es requerido'
        ]));
//        $validator->add(
//                'fecha', new PresenceOfValidator([
//                    'message' => 'El campo fecha es requerido'
//        ]));

//        $validator->add(
//                'Descripcion', new PresenceOfValidator([
//                    'message' => 'El campo texto descripcion es requerido'
//        ]));

//        $validator->add(
//                'imagen', new PresenceOfValidator([
//                    'message' => 'El campo imagen es requerido'
//        ]));


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
