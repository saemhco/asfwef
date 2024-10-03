<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class DbuDerivacionServicios extends Model {

    public function initialize() {
        $this->setSource('tbl_dbu_derivacion_servicios');
    }

    public function validation() {
        $validator = new Validation();



        // $validator->add(
        //         'nro_doc', new PresenceOfValidator([
        //             'message' => 'El campo numero de documento es requerido'
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
