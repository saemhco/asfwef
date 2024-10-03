<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;

class RequerimientoServicio extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_hdt_req_servicios');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'id_tipo_servicio',
            new PresenceOfValidator([
                'message' => 'El campo tipo de servicio es requerido'
            ])
        );

        $validator->add(
            'id_prioridad',
            new PresenceOfValidator([
                'message' => 'El campo prioridad es requerido'
            ])
        );

        $validator->add(
            'id_area',
            new PresenceOfValidator([
                'message' => 'El campo area es requerido'
            ])
        );

        $validator->add(
            'id_personal',
            new PresenceOfValidator([
                'message' => 'El campo personal es requerido'
            ])
        );

        $validator->add(
            'fecha_inicio', new PresenceOfValidator([
                'message' => 'El campo fecha inicio es requerido'
    ]));


    $validator->add(
        'fecha_fin', new PresenceOfValidator([
            'message' => 'El campo fecha fin es requerido'
]));


        $validator->add(
            "solucion",
            new StringLengthValidator(
                    [
                //"max" => 50,
                "min" => 10,
                //"messageMaximum" => "Name too long",
                "messageMinimum" => "El campo solucion debe tener minimo 10 caracteres",
                //"includedMaximum" => true,
                //"includedMinimum" => false,
                    ]
            )
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
