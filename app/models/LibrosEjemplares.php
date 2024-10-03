<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class LibrosEjemplares extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_lib_libros_ejemplares');
    }

    public function validation()
    {
        // $validator = new Validation();

        // $validator->add(
        //     'id_ejemplar',
        //     new PresenceOfValidator([
        //         'message' => 'El campo id_ejemplar del libro es requerido'
        //     ])
        // );

        // return $this->validate($validator);
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
