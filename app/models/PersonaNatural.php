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
class PersonaNatural extends Model {

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

        $validator->add(
                'telefono', new PresenceOfValidator([
                    'message' => 'El campo Telefono es requerido'
        ]));

        $validator->add(
                'direccion', new PresenceOfValidator([
                    'message' => 'El campo Direccion es requerido'
        ]));

        $validator->add(
                'email', new EmailValidator([
                    'message' => 'El campo email es requerido y debe tener "@"'
        ]));


        $validator->add(
                'email', new UniquenessValidator([
                    'message' => 'El email ya esta registrado'
        ]));

        $validator->add(
                'region', new PresenceOfValidator([
                    'message' => 'El campo region es requerido'
        ]));

        $validator->add(
                'provincia', new PresenceOfValidator([
                    'message' => 'El campo provincia es requerido'
        ]));

        $validator->add(
                'distrito', new PresenceOfValidator([
                    'message' => 'El campo distrito es requerido'
        ]));

        $validator->add(
                'ubigeo', new PresenceOfValidator([
                    'message' => 'El campo ubigeo es requerido'
        ]));

        $validator->add(
                'password', new PresenceOfValidator([
                    'message' => 'El campo password es requerido'
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
