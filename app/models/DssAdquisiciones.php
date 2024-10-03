<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class DssAdquisiciones extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_dss_adquisiciones');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'tipo',
            new PresenceOfValidator([
                'message' => 'El campo tipo es requerido'
            ])
        );

        $validator->add(
            'fecha_adquisicion',
            new PresenceOfValidator([
                'message' => 'El campo fecha adquisicion es requerido'
            ])
        );

        $validator->add(
            'descripcion',
            new PresenceOfValidator([
                'message' => 'El campo descripcion es requerido'
            ])
        );

        $validator->add(
            'numero_oc',
            new PresenceOfValidator([
                'message' => 'El campo numero es requerido'
            ])
        );
        
        $validator->add(
            'precio',
            new PresenceOfValidator([
                'message' => 'El campo precio es requerido'
            ])
        );

        $validator->add(
            'observaciones',
            new PresenceOfValidator([
                'message' => 'El campo observaciones es requerido'
            ])
        );


        return $this->validate($validator);
    }

    public function getMessages($filter = NULL)
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
