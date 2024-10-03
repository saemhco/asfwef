<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class Testimonios extends Model {

    /**
     * @var integer
     */
    public $testimonio_id;

    /**
     * @var string
     */
    public $titulo;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $imagen;

    /**
     * @var string
     */
    public $fecha;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_btr_testimonios");
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'titulo', new PresenceOfValidator([
            'message' => 'El campo Titulo es requerido'
        ]));

        $validator->add(
                'descripcion', new PresenceOfValidator([
            'message' => 'El campo Descripcion es requerido'
        ]));


        $validator->add(
                'imagen', new PresenceOfValidator([
            'message' => 'El campo Imagen es requerido'
        ]));

        $validator->add(
                'fecha', new PresenceOfValidator([
            'message' => 'El campo Fecha es requerido'
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
