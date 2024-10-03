<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;

/**
 * Types of Products
 */
class Empleos extends Model {

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_btr_empleos");
    }

    public function validation() {

        $validator = new Validation();

        $validator->add(
                'region_id', new PresenceOfValidator([
                    'message' => 'El campo Region es requerido'
        ]));

        $validator->add(
                'provincia_id', new PresenceOfValidator([
                    'message' => 'El campo Provincia es requerido'
        ]));



        $validator->add(
                'ubigeo_id', new PresenceOfValidator([
                    'message' => 'El campo Ubigeo es requerido'
        ]));

        $validator->add(
                'ciudad', new PresenceOfValidator([
                    'message' => 'El campo ciudad es requerido'
        ]));



        $validator->add(
                'distrito_id', new PresenceOfValidator([
                    'message' => 'El campo Distrito es requerido'
        ]));

        $validator->add(
                'cargo', new PresenceOfValidator([
                    'message' => 'El campo Cargo u Ocupación es requerido'
        ]));

        $validator->add(
                'jornada', new PresenceOfValidator([
                    'message' => 'El campo Jornada es requerido'
        ]));

        $validator->add(
                'tipocontrato', new PresenceOfValidator([
                    'message' => 'El campo Tipo de Contrato es requerido'
        ]));

        $validator->add(
                'fecha_clausura', new PresenceOfValidator([
                    'message' => 'El campo Fecha de Clausura es requerido'
        ]));

        $validator->add(
                'titulo', new PresenceOfValidator([
                    'message' => 'El campo Titulo es requerido'
        ]));

        $validator->add(
                'descripcion', new PresenceOfValidator([
                    'message' => 'El campo Descripcion es requerido'
        ]));

        $validator->add(
                'requisitos', new PresenceOfValidator([
                    'message' => 'El campo Requisitos es requerido'
        ]));

        $validator->add(
                'salario', new PresenceOfValidator([
                    'message' => 'El campo Salario es requerido'
        ]));

        //Validamos el campo dni de acuerdo al nombre de la bd
        $validator->add(
                "salario", new RegexValidator(
                        [
                    "pattern" => "/[0-9]{3,14}/",
                    "message" => "Debe ser numerico entre 3 y 14 digitos",
                        ]
                )
        );

        $validator->add(
                'cantidad_vacantes', new PresenceOfValidator([
                    'message' => 'El campo Cantidad de vacantes es requerido'
        ]));

        //Validamos el campo dni de acuerdo al nombre de la bd
        $validator->add(
                "cantidad_vacantes", new RegexValidator(
                        [
                    "pattern" => "/[0-9]{1,2}/",
                    "message" => "Debe ser numerico entre 1 y 2 digitos",
                        ]
                )
        );

        return $this->validate($validator);
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
