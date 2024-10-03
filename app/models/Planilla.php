<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Digit as DigitValidator;

class Planilla extends Model {

    public function initialize() {
        $this->setSource('tbl_per_planillas');
    }

    public function validation() {
        $validator = new Validation();


        $validator->add(
                'anio', new PresenceOfValidator([
                    'message' => 'El campo Año  es requerido'
        ]));

        $validator->add(
                'numero', new PresenceOfValidator([
                    'message' => 'El campo numero yes requerido'
        ]));

        $validator->add(
                'periodo', new PresenceOfValidator([
                    'message' => 'El campo periodo es requerido'
        ]));

        $validator->add(
                'id_planilla_tipo', new PresenceOfValidator([
                    'message' => 'El campo tipo periodo es requerido'
        ]));
        

        $validator->add(
                'fecha_inicio', new PresenceOfValidator([
                    'message' => 'El campo fecha de inicio es requerido'
        ]));

         $validator->add(
                'fecha_fin', new PresenceOfValidator([
                    'message' => 'El campo fecha fin es requerido'
        ]));

        $validator->add(
                'especifica', new PresenceOfValidator([
                    'message' => 'El campo Especifica  es requerido'
        ]));

        $validator->add(
                'fuente_financ', new PresenceOfValidator([
                    'message' => 'El campo Fuente de Financiamiento  es requerido'
        ]));

        $validator->add(
                'tipo_recurso', new PresenceOfValidator([
                    'message' => 'El campo Tipo Recurso  es requerido'
        ]));

        $validator->add(
                'referencia', new PresenceOfValidator([
                    'message' => 'El campo Referencia  es requerido'
        ]));
       


        return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
