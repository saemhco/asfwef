<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class AlumnosSolicitudes extends Model {

    /**
     * @var string
     */
    public $numero;

    /**
     * @var string
     */
    public $codigo;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $archivo;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_reg_alumnos_solicitudes");
    }

    public function validation() {
        $validator = new Validation();

        /*
        $validator->add(
                'area', new PresenceOfValidator([
                    'message' => 'El campo destinatario es requerido'
        ]));
        */

        $validator->add(
                'tipo', new PresenceOfValidator([
                    'message' => 'El campo solicitud es requerido'
        ]));


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
