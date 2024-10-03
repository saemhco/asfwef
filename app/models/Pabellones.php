<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class Pabellones extends Model {

    public function initialize() {
        $this->setSource("tbl_web_pabellones");
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
