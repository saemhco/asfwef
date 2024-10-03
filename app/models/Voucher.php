<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;


class Voucher extends Model {

    public function initialize() {
        $this->setSource('tbl_web_convocatorias_voucher');
    }

    public function validation() {
       /* $validator = new Validation();

        $validator->add(
                'convocatoria', new PresenceOfValidator([
                    'message' => 'El campo convocatoria es requerido'
        ]));

        $validator->add(
                'archivo', new PresenceOfValidator([
                    'message' => 'Tiene que seleccionar un archivo'
        ]));*/

        //$validator->add(
        //'archivo', new PresenceOfValidator([
        //'message' => 'El campo archivo es requerido'
        //]));

        //return $this->validate($validator);
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
