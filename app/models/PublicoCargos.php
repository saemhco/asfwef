<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class PublicoCargos extends Model
{

    public function initialize()
    {
        $this->setSource("tbl_web_publico_cargos");
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
            'id_tipo_cargo',
            new PresenceOfValidator([
                'message' => 'El campo tipo es requerido'
            ])
        );

        $validator->add(
            'nombre',
            new PresenceOfValidator([
                'message' => 'El campo cargo es requerido'
            ])
        );

        //fecha_inicio
        $validator->add(
            'fecha_inicio',
            new PresenceOfValidator([
                'message' => 'El campo fecha inicio es requerido'
            ])
        );

        //fecha_fin
        /* ya no
        $validator->add(
            'fecha_fin',
            new PresenceOfValidator([
                'message' => 'El campo fecha fin es requerido'
            ])
        );
        */

        //tiempo
        $validator->add(
            'tiempo',
            new PresenceOfValidator([
                'message' => 'El campo tiempo es requerido'
            ])
        );

        //institucion
        $validator->add(
            'institucion',
            new PresenceOfValidator([
                'message' => 'El campo institucion es requerido'
            ])
        );

        //institucion
        $validator->add(
            'tipo_institucion',
            new PresenceOfValidator([
                'message' => 'El campo tipo de institucion es requerido'
            ])
        );

        //funciones
        //        $validator->add(
        //                'funciones', new PresenceOfValidator([
        //                    'message' => 'El campo funciones es requerido'
        //        ]));

        //archivo
        //        $validator->add(
        //                'archivo', new PresenceOfValidator([
        //                    'message' => 'El campo archivo es requerido'
        //        ]));


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
