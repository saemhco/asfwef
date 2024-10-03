<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Contratos extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_per_contratos');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'contrato',
            new PresenceOfValidator([
                'message' => 'El campo contrato es requerido'
            ])
        );

        $validator->add(
            'certificacion',
            new PresenceOfValidator([
                'message' => 'El campo certificacion es requerido'
            ])
        );

        $validator->add(
            'concurso',
            new PresenceOfValidator([
                'message' => 'El campo concurso tipo es requerido'
            ])
        );

        //resolucion
        $validator->add(
            'resolucion',
            new PresenceOfValidator([
                'message' => 'El campo resolucion es requerido'
            ])
        );

        //personal
        $validator->add(
            'personal',
            new PresenceOfValidator([
                'message' => 'El campo personal es requerido'
            ])
        );

        //area
        $validator->add(
            'area',
            new PresenceOfValidator([
                'message' => 'El campo area es requerido'
            ])
        );

        //carrera
        //        $validator->add(
        //                'carrera', new PresenceOfValidator([
        //                    'message' => 'El campo carrera es requerido'
        //        ]));
        //condicion
        $validator->add(
            'condicion',
            new PresenceOfValidator([
                'message' => 'El campo condicion es requerido'
            ])
        );
        //regimen
        $validator->add(
            'regimen',
            new PresenceOfValidator([
                'message' => 'El campo regimen es requerido'
            ])
        );
        //categoria_laboral
        $validator->add(
            'categoria_laboral',
            new PresenceOfValidator([
                'message' => 'El campo categoria laboral es requerido'
            ])
        );
        //tipo_dependencia
        $validator->add(
            'tipo_dependencia',
            new PresenceOfValidator([
                'message' => 'El campo tipo dependencia es requerido'
            ])
        );
        //dependencia
        $validator->add(
            'dependencia',
            new PresenceOfValidator([
                'message' => 'El campo dependencia es requerido'
            ])
        );
        //local
        $validator->add(
            'local',
            new PresenceOfValidator([
                'message' => 'El campo local es requerido'
            ])
        );
        //nivel_remunerativo
        $validator->add(
            'nivel_remunerativo',
            new PresenceOfValidator([
                'message' => 'El campo nivel remunerativo es requerido'
            ])
        );
        //monto
        $validator->add(
            'monto',
            new PresenceOfValidator([
                'message' => 'El campo monto es requerido'
            ])
        );

        //cargo
        $validator->add(
            'cargo',
            new PresenceOfValidator([
                'message' => 'El campo cargo es requerido'
            ])
        );

        //cargo_general
        $validator->add(
            'cargo_general',
            new PresenceOfValidator([
                'message' => 'El campo cargo_general es requerido'
            ])
        );

        //cargo_general
        $validator->add(
            'fecha_fin',
            new PresenceOfValidator([
                'message' => 'El campo fecha fin es requerido'
            ])
        );


        return $this->validate($validator);
    }

    //paginador


    public function getMessages($filter = NULL)
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
