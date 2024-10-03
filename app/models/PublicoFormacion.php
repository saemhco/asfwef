<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class PublicoFormacion extends Model {

    public function initialize() {
        $this->setSource("tbl_web_publico_formacion");
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//                'codigo', new PresenceOfValidator([
//                    'message' => 'El campo codigo es requerido'
//        ]));


        $validator->add(
                'publico', new PresenceOfValidator([
                    'message' => 'El campo publico es requerido'
        ]));


        $validator->add(
                'grado', new PresenceOfValidator([
                    'message' => 'El campo grado es requerido'
        ]));

        $validator->add(
                'nombre', new PresenceOfValidator([
                    'message' => 'El campo nombre es requerido'
        ]));

        //fecha_grado
        $validator->add(
                'fecha_grado', new PresenceOfValidator([
                    'message' => 'El campo fecha del grado es requerido'
        ]));

        //institucion
        $validator->add(
                'institucion', new PresenceOfValidator([
                    'message' => 'El campo institucion es requerido'
        ]));

        //pais
        $validator->add(
                'pais', new PresenceOfValidator([
                    'message' => 'El campo pais es requerido'
        ]));

        //archivo
//        $validator->add(
//                'archivo', new PresenceOfValidator([
//                    'message' => 'El campo archivo es requerido'
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
