<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;

/**
 * Types of Products
 */
class PrestamosRechazados extends Model {

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_lib_libros_prestamos");
    }

    public function validation() {
        $validator = new Validation();




        $validator->add(
                'fecha_entrega', new PresenceOfValidator([
                    'message' => 'El campo fecha entrega es requerido'
        ]));



        $validator->add(
                "observacion",
                new StringLengthValidator(
                        [
                    //"max" => 50,
                    "min" => 10,
                    //"messageMaximum" => "Name too long",
                    "messageMinimum" => "El campo observacion debe tener minimo 10 caracteres",
                    //"includedMaximum" => true,
                    //"includedMinimum" => false,
                        ]
                )
        );


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
