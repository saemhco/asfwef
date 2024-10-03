<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;

class DocprocesosArchivos extends Model {

    public function initialize() {
        $this->setSource('tbl_web_docprocesos_archivos');
    }

    public function validation() {
        $validator = new Validation();
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
