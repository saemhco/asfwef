<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class SolicitudServicios extends Model {

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
    public $nombres;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_dbu_solicitud_servicios");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'id_servicio', new PresenceOfValidator([
                    'message' => 'El campo servicio es requerido'
        ]));

        $validator->add(
                'asunto', new PresenceOfValidator([
                    'message' => 'El campo asunto es requerido'
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
