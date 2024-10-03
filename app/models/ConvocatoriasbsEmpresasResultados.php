<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class ConvocatoriasbsEmpresasResultados extends Model {

    public function initialize() {
        $this->setSource('tbl_web_convocatorias_bs_empresas');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'proceso', new PresenceOfValidator([
                    'message' => 'Selecione una opción'
        ]));

        return $this->validate($validator);
    }

    //paginador


    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
