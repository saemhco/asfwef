<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class LineasInvestigacion extends Model {

    public function initialize() {
        $this->setSource("tbl_inv_lineas_investigacion");
    }

    public function validation() {
        $validator = new Validation();

        // $validator->add(
        //         'descripcion', new PresenceOfValidator([
        //     'message' => 'El campo descripcion es requerido'
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
