<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
//paginador
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

/**
 * Types of Products
 */
class UglNexus extends Model
{

    public function initialize()
    {
        $this->setSource("tbl_ugl_nexus");
    }

    public function validation()
    {
        $validator = new Validation();

        // $validator->add(
        //     'descripcion', new PresenceOfValidator([
        //         'message' => 'El nombre del autor es requerido'
        //     ]));


        //        $validator->add(
        //            'nacionalidad', new PresenceOfValidator([
        //                'message' => 'La nacionalidad del autor es requerido'
        //            ]));

        return $this->validate($validator);
    }

    public function getMessages($filter = NULL)
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
