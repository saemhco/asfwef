<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class Docentes extends Model {

    /**
     * @var integer
     */
    public $autor_id;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("docentes");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'nombres', new PresenceOfValidator([
                    'message' => 'El campo nombres son requeridos'
        ]));

        $validator->add(
                'apellidop', new PresenceOfValidator([
                    'message' => 'El apellido paterno es requerido'
        ]));

        $validator->add(
                'apellidom', new PresenceOfValidator([
                    'message' => 'El apellido materno es requerido'
        ]));

        $validator->add(
                'nro_doc', new PresenceOfValidator([
                    'message' => 'El dni es requerido'
        ]));


//        $validator->add(
//                'gradom', new PresenceOfValidator([
//                    'message' => 'El campo grado maximo es requerido'
//        ]));
//
//        $validator->add(
//                'grado_otro', new PresenceOfValidator([
//                    'message' => 'El campo grado academico otro es requerido'
//        ]));
//        $validator->add(
//                'gradom_otro', new PresenceOfValidator([
//                    'message' => 'El campo grado maximo otro es requerido'
//        ]));
//        $validator->add(
//                'grado_mencion_otro', new PresenceOfValidator([
//                    'message' => 'El campo grado mencion otro es requerido'
//        ]));
//
//        $validator->add(
//                'grado_universidad_otro', new PresenceOfValidator([
//                    'message' => 'El campo grado universidad otro es requerido'
//        ]));
//        
//        $validator->add(
//                'pais_universidad_otro', new PresenceOfValidator([
//                    'message' => 'El campo pais universidad otro es requerido'
//        ]));

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
