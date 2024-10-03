<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class EncuestasPreguntas extends Model
{
    /**
     * @var integer
     */
    public $tc_id;

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
        $this->setSource("tbl_enc_encuestas_preguntas");
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'id_tipo_pregunta',
            new PresenceOfValidator([
                'message' => 'El campo tipo de pregunta es requerido'
            ])
        );

        $validator->add(
            'id_tipo_respuesta',
            new PresenceOfValidator([
                'message' => 'El campo tipo de respuesta es requerido'
            ])
        );

        $validator->add(
            'numero',
            new PresenceOfValidator([
                'message' => 'El campo numero es requerido'
            ])
        );

        $validator->add(
            'descripcion',
            new PresenceOfValidator([
                'message' => 'El campo descripcion es requerido'
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
