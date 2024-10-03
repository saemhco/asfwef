<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Encuestas extends Model
{
    /**
     * @var integer
     */
    public $autor_id;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("tbl_enc_encuestas");
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'id_tipo_encuesta',
            new PresenceOfValidator([
                'message' => 'El campo tipo de encuesta es requerido'
            ])
        );



        $validator->add(
            'descripcion',
            new PresenceOfValidator([
                'message' => 'El campo descripcion es requerido'
            ])
        );

        $validator->add(
            'indicaciones',
            new PresenceOfValidator([
                'message' => 'El campo indicaciones es requerido'
            ])
        );



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
