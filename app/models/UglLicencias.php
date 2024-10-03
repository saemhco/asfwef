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
class UglLicencias extends Model
{

    public function initialize()
    {
        $this->setSource("tbl_ugl_licencias");
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'id_tipo',
            new PresenceOfValidator([
                'message' => 'El campo tipo es requerido'
            ])
        );


        $validator->add(
            'id_motivo',
            new PresenceOfValidator([
                'message' => 'El campo motivo es requerido'
            ])
        );


        $validator->add(
            'id_situacion',
            new PresenceOfValidator([
                'message' => 'El campo situacion es requerido'
            ])
        );


        $validator->add(
            'fecha_inicio',
            new PresenceOfValidator([
                'message' => 'El campo fecha inicio es requerido'
            ])
        );

        $validator->add(
            'fecha_fin',
            new PresenceOfValidator([
                'message' => 'El campo fecha fin es requerido'
            ])
        );



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
