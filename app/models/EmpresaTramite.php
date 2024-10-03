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
class EmpresaTramite extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("tbl_btr_empresas");
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'ruc', new PresenceOfValidator([
                'message' => 'El campo Ruc es requerido',
            ]));

        $validator->add(
            'razon_social', new PresenceOfValidator([
                'message' => 'El campo Razon Social es requerido',
            ]));

        $validator->add(
            'email', new EmailValidator([
                'message' => 'Email incorrecto',
            ]));

        $validator->add(
            'email', new PresenceOfValidator([
                'message' => 'El campo Email es requerido',
            ]));

        $validator->add(
            'representante', new PresenceOfValidator([
                'message' => 'El campo Representante es requerido',
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
