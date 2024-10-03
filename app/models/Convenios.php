<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
//paginador
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class Convenios extends Model {

    public function initialize() {
        $this->setSource('tbl_web_convenios');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
                'titulo', new PresenceOfValidator([
                    'message' => 'El campo titulo es requerido'
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
