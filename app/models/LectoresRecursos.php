<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;

class LectoresRecursos extends Model {

    public function initialize() {
        $this->setSource('view_lectores');
    }

    public function validation() {

        $validator = new Validation();


//
//         $validator->add(
//            'dni', new PresenceOfValidator([
//
//                'message' => 'El campo DNI es requerido'
//            ]));
//
//
//        //Validamos el campo dni de acuerdo al nombre de la bd
//        $validator->add(
//            "dni",
//            new RegexValidator(
//                [
//                    "pattern" => "/[0-9]{8}/",
//                    "message" => "Debe ser numerico de 8 caracteres",
//                ]
//            )
//        );
//
//        //Validamos el  campo DNI para que sea unico
//        $validator->add(
//
//            'dni', new UniquenessValidator([
//                'message' => 'El campo dni ya esta siendo usado'
//
//            ]));
//
//
//        $validator->add(
//            'nombres', new PresenceOfValidator([
//
//                'message' => 'El campo nombres es requerido'
//            ]));
//
//
//
//        $validator->add(
//            'ap_paterno', new PresenceOfValidator([
//
//                'message' => 'El  campo apellido paterno es requerido'
//            ]));
//
//
//        $validator->add(
//            'ap_materno', new PresenceOfValidator([
//
//                'message' => 'El campo apellido materno es requerido'
//            ]));
//
//        $validator->add(
//            'telefono', new PresenceOfValidator([
//
//                'message' => 'El  campo telefono es requerido'
//            ]));
//
//
//        $validator->add(
//            'direccion', new PresenceOfValidator([
//
//                'message' => 'El  campo direccion es requerido'
//            ]));
//
//
//        //Validamos el campo email de acuerdo al nombre de la bd
//        $validator->add(
//            'email',
//            new EmailValidator([
//                'message' => 'Email incorrecto'
//            ]));
//
//
//        //Validamos el campo Email para que sea unico
//        $validator->add(
//
//            'email', new UniquenessValidator([
//                'message' => 'El campo email ya esta siendo usado'
//            ]));
//
//
//        $validator->add(
//            'codigo_lector', new PresenceOfValidator([
//
//                'message' => 'El  campo codigo de lector es requerido'
//            ]));
//
//
//                //Validamos el campo password de acuerdo al nombre de la bd
//        $validator->add(
//            'password', new PresenceOfValidator([
//                'message' => 'El campo contraseña es requerido'
//            ]));
//
//
//
//
//
//        //Validamos Sexo
//        $validator->add(
//            'sexo', new PresenceOfValidator([
//
//                'message' => 'El campo Sexo es requerido'
//            ]));
//
//        //Validamos el tipo de lector
//        $validator->add(
//            'tipolector_id', new PresenceOfValidator([
//                'message' => 'El campo Tipo de lector es requerido'
//            ]));
//
//
//
//
//                //Validamos el tipo de lector
//        $validator->add(
//            'programa_id', new PresenceOfValidator([
//                'message' => 'El campo Programas es requerido'
//            ]));
//
//
//
//                //Validamos el tipo de lector
//        $validator->add(
//            'img', new PresenceOfValidator([
//                'message' => 'El campo Imagen es requerido'
//            ]));






        return $this->validate($validator);
    }
    
    public function getMessages()
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["".$message->getField()] = '<div class="text-danger errorforms">'.$message->getMessage().'</div>';        
        }
        return $messages;
    }

}
