<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class DocumentosDetalles extends Model {

    public function initialize() {
        $this->setSource('tbl_doc_documentos_detalles');
    }

    public function validation() {
        $validator = new Validation();

        // $validator->add(
        //         'id', new PresenceOfValidator([
        //             'message' => 'El campo id es requerido'
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
