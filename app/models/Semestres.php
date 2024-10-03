<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
//subiendo
/**
 * Types of Products
 */
class Semestres extends Model {

    /**
     * @var integer
     */
    public $codigo;

    /**
     * @var string
     */
    public $descripcion;
    /**
     * @var string
     */
    public $semestre;
    /**
     * @var string
     */
    public $fecha_inicio;
    /**
     * @var string
     */
    public $fecha_fin;
    /**
     * @var string
     */
    public $anio;
    /**
     * @var string
     */
    public $observacion;
    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("semestres");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'descripcion', new PresenceOfValidator([
            'message' => 'La descripcion es requerida'
        ]));

        $validator->add(
                'semestre', new PresenceOfValidator([
            'message' => 'El semestre es requerido'
        ]));

        $validator->add(
                'anio', new PresenceOfValidator([
            'message' => 'El anio es requerido'
        ]));

        return $this->validate($validator);
    }

    /*
    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
    */
}
