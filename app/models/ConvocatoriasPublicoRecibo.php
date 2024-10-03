<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class ConvocatoriasPublicoRecibo extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_web_convocatorias_publico');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'nro_recibo',
            new PresenceOfValidator([
                'message' => 'El campo numero de recibo es requerido'
            ])
        );


        $validator->add(
            'monto_recibo',
            new PresenceOfValidator([
                'message' => 'El campo monto recibo es requerido'
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
