<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

/**
 * Types of Products
 */
class EmpresaPublico extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("tbl_web_empresa_publico");
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email', new UniquenessValidator([
                'message' => 'El email ya esta registrado',
            ]));

        $validator->add(
            'email', new EmailValidator([
                'message' => 'El campo email es requerido y debe tener "@"',
            ]));

        return $this->validate($validator);
    }

    public function getMessages()
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
