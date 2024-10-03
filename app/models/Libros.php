<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class Libros extends Model
{

    public function initialize()
    {
        $this->setSource('tbl_lib_libros');
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'codigo',
            new PresenceOfValidator([
                'message' => 'El campo codigo del libro es requerido'
            ])
        );

        $validator->add(
            'titulo',
            new PresenceOfValidator([
                'message' => 'El campo titulo es requerido'
            ])
        );

        $validator->add(
            'isbn',
            new PresenceOfValidator([
                'message' => 'El campo isbn es requerido'
            ])
        );

        $validator->add(
            'codigo_barra',
            new PresenceOfValidator([
                'message' => 'El campo codigo de barras es requerido'
            ])
        );

        $validator->add(
            'autor_1',
            new PresenceOfValidator([
                'message' => 'El campo autor 1 es requerido'
            ])
        );

        $validator->add(
            'editorial',
            new PresenceOfValidator([
                'message' => 'El campo editorial es requerido'
            ])
        );

        $validator->add(
            'tipo_material_bibliografico',
            new PresenceOfValidator([
                'message' => 'El campo tipo de material bibliografico es requerido'
            ])
        );

        $validator->add(
            'idioma',
            new PresenceOfValidator([
                'message' => 'El campo idioma es requerido'
            ])
        );


        $validator->add(
            'categoria',
            new PresenceOfValidator([
                'message' => 'El campo categoria es requerido'
            ])
        );

        $validator->add(
            'cantidad_ejemplares',
            new PresenceOfValidator([
                'message' => 'El campo cantidad ejemplares es requerido'
            ])
        );

        $validator->add(
            'paginas',
            new PresenceOfValidator([
                'message' => 'El campo paginas es requerido'
            ])
        );

        $validator->add(
            'anio_publicacion',
            new PresenceOfValidator([
                'message' => 'El campo año publicacion es requerido'
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
