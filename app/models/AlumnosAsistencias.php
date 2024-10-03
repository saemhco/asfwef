<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class AlumnosAsistencias extends Model {

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
        $this->setSource("alumnos_asistencias");
    }

    public function validation() {
        $validator = new Validation();

        //asistencia
        $validator->add(
                'asistencia', new PresenceOfValidator([
                    'message' => 'La asistencia es obligatorio'
        ]));

        //alumno
        $validator->add(
                'alumno', new PresenceOfValidator([
                    'message' => 'La alumno es obligatorio'
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
