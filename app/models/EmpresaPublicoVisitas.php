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
class EmpresaPublicoVisitas extends Model {

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_web_empresa_publico");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'id_empresa', new PresenceOfValidator([
                    'message' => 'El campo empresa es requerido'
        ]));

        $validator->add(
                'id_publico', new PresenceOfValidator([
                    'message' => 'El campo publico es requerido'
        ]));

        $validator->add(
            'email', new PresenceOfValidator([
                'message' => 'El campo email es requerido'
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
