<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class AsistenciasSemestre extends Model {

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("asistencias_semestre");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'tipo', new PresenceOfValidator([
                    'message' => 'El campo tipo es requerido'
        ]));

        $validator->add(
                'fecha', new PresenceOfValidator([
                    'message' => 'El campo fecha es requerido'
        ]));

        $validator->add(
                'tema', new PresenceOfValidator([
                    'message' => 'El campo tema es requerido'
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
