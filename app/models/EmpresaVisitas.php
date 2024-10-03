<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;

/**
 * Types of Products
 */
class EmpresaVisitas extends Model {

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_btr_empresas");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'razon_social', new PresenceOfValidator([
                    'message' => 'El campo Razon Social es requerido'
        ]));

        $validator->add(
                'ruc', new PresenceOfValidator([
                    'message' => 'El campo Ruc es requerido'
        ]));


        $validator->add(
                'ruc', new UniquenessValidator([
                    'message' => 'El numero de RUC ya esta siendo usado'
        ]));

        $validator->add(
                "ruc", new RegexValidator(
                        [
                    "pattern" => "/[0-9]{11}/",
                    "message" => "Debe ser numerico de 11 caracteres",
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
