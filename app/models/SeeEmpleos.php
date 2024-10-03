<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;

/**
 * Types of Products
 */
class SeeEmpleos extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("tbl_see_empleos");
    }

    public function validation()
    {

        $validator = new Validation();

        $validator->add(
            'id_tipocontrato',
            new PresenceOfValidator([
                'message' => 'El campo tipo de contrato es requerido'
            ])
        );

        
        $validator->add(
            'id_cargo',
            new PresenceOfValidator([
                'message' => 'El campo cargo es requerido'
            ])
        );

        $validator->add(
            'id_jornada',
            new PresenceOfValidator([
                'message' => 'El campo jornada es requerido'
            ])
        );

        $validator->add(
            'id_empresa',
            new PresenceOfValidator([
                'message' => 'El campo empresa es requerido'
            ])
        );

        $validator->add(
            'fecha_inicio',
            new PresenceOfValidator([
                'message' => 'El campo fecha inicio es requerido'
            ])
        );

        $validator->add(
            'fecha_fin',
            new PresenceOfValidator([
                'message' => 'El campo fecha fin es requerido'
            ])
        );

        $validator->add(
            'ciudad',
            new PresenceOfValidator([
                'message' => 'El campo ciudad es requerido'
            ])
        );

        $validator->add(
            'region_id',
            new PresenceOfValidator([
                'message' => 'El campo region es requerido'
            ])
        );

        $validator->add(
            'provincia_id',
            new PresenceOfValidator([
                'message' => 'El campo provincia es requerido'
            ])
        );



        $validator->add(
            'ubigeo_id',
            new PresenceOfValidator([
                'message' => 'El campo ubigeo es requerido'
            ])
        );

        $validator->add(
            'ciudad',
            new PresenceOfValidator([
                'message' => 'El campo ciudad es requerido'
            ])
        );



        $validator->add(
            'distrito_id',
            new PresenceOfValidator([
                'message' => 'El campo Distrito es requerido'
            ])
        );






        $validator->add(
            'titulo',
            new PresenceOfValidator([
                'message' => 'El campo Titulo es requerido'
            ])
        );



        $validator->add(
            'remuneracion',
            new PresenceOfValidator([
                'message' => 'El campo remuneracion es requerido'
            ])
        );

        $validator->add(
            "remuneracion",
            new RegexValidator(
                [
                    "pattern" => "/[0-9]{3,14}/",
                    "message" => "Debe ser numerico entre 3 y 14 digitos",
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
