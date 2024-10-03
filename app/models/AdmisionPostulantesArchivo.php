<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;

class AdmisionPostulantesArchivo extends Model {

    public function initialize() {
        $this->setSource('admision_postulantes_archivo');
    }

    public function validation() {
        $validator = new Validation();
        return $this->validate($validator);
    }

    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errordforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
