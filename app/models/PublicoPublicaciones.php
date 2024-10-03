<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class PublicoPublicaciones extends Model
{

    public function initialize()
    {
        $this->setSource("tbl_web_publico_publicaciones");
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
            'id_tipo_publicacion',
            new PresenceOfValidator([
                'message' => 'El campo tipo publicacion es requerido'
            ])
        );



        $validator->add(
            'nombre',
            new PresenceOfValidator([
                'message' => 'El campo nombre es requerido'
            ])
        );

        //fecha_grado
        $validator->add(
            'fecha_publicacion',
            new PresenceOfValidator([
                'message' => 'El campo fecha piblicacion del grado es requerido'
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
