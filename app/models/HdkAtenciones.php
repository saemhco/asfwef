<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class HdkAtenciones extends Model {

    public function initialize() {
        $this->setSource('tbl_hdk_atenciones');
    }

    public function validation() {

        $validator = new Validation();

        $validator->add(
                'tipo', new PresenceOfValidator([
                    'message' => 'El campo tipo de atención es requerido'
        ]));

        $validator->add(
                'prioridad', new PresenceOfValidator([
                    'message' => 'El campo prioridad es requerido'
        ]));

        $validator->add(
                'asunto', new PresenceOfValidator([
                    'message' => 'El campo asunto es requerido'
        ]));

        $validator->add(
                'descripcion', new PresenceOfValidator([
                    'message' => 'El campo descripcion es requerido'
        ]));

        $validator->add(
                'pedido', new PresenceOfValidator([
                    'message' => 'El campo pedido es requerido'
        ]));

        $validator->add(
                'publico', new PresenceOfValidator([
                    'message' => 'Debe agregar un usuario'
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
