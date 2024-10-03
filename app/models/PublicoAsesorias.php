<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class PublicoAsesorias extends Model
{

    public function initialize()
    {
        $this->setSource("tbl_web_publico_asesorias");
    }

    public function validation()
    {
        $validator = new Validation();

        //        $validator->add(
        //                'codigo', new PresenceOfValidator([
        //                    'message' => 'El campo codigo es requerido'
        //        ]));


        $validator->add(
            'publico',
            new PresenceOfValidator([
                'message' => 'El campo publico es requerido'
            ])
        );


        $validator->add(
            'id_grado',
            new PresenceOfValidator([
                'message' => 'El campo grado es requerido'
            ])
        );

        $validator->add(
            'id_universidad',
            new PresenceOfValidator([
                'message' => 'El campo universidad es requerido'
            ])
        );

        $validator->add(
            'tesista',
            new PresenceOfValidator([
                'message' => 'El campo tesista es requerido'
            ])
        );

        //fecha_grado
        $validator->add(
            'fecha',
            new PresenceOfValidator([
                'message' => 'El campo fecha del grado es requerido'
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
