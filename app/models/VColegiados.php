<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
//paginador
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class VColegiados extends Model {

    public function initialize() {
        $this->setSource('view_colegiados');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'codigo', new PresenceOfValidator([
                    'message' => 'El campo numero es requerido'
        ]));

        

        //$validator->add(
        //'archivo', new PresenceOfValidator([
        //'message' => 'El campo archivo es requerido'
        //]));

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
