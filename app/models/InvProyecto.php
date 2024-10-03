<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class InvProyecto extends Model {

    public function initialize() {
        
        //llamamos al nombre de la funcion de service.php
        //$this->setConnectionService('db');
        $this->setSource('tbl_inv_proyectos');
    }

    public function validation() {
        $validator = new Validation();

        $validator->add(
            'investigador', new PresenceOfValidator([
            'message' => 'El campo investigador es requerido'
        ]));
        $validator->add(
            'titulo', new PresenceOfValidator([
            'message' => 'El campo titulo es requerido'
        ]));

        $validator->add(
            'objetivo', new PresenceOfValidator([
            'message' => 'El campo objetivo es requerido'
        ]));
        $validator->add(
            'objetivos', new PresenceOfValidator([
            'message' => 'El campo objetivos es requerido'
        ]));
        $validator->add(
            'fecha_inicio', new PresenceOfValidator([
            'message' => 'El campo fecha inicio es requerido'
        ]));
        $validator->add(
            'fecha_termino', new PresenceOfValidator([
            'message' => 'El campo fecha termino es requerido'
        ]));
        $validator->add(
            'vigencia', new PresenceOfValidator([
            'message' => 'El campo vigencia es requerido'
        ]));
        $validator->add(
            'presupuesto', new PresenceOfValidator([
            'message' => 'El campo presupuesto es requerido'
        ]));
        $validator->add(
            'entidad_cooperante', new PresenceOfValidator([
            'message' => 'El campo entidad cooperante es requerido'
        ]));

        $validator->add(
            'local_proyecto', new PresenceOfValidator([
            'message' => 'El campo local proyecto es requerido'
        ]));     
        $validator->add(
            'etapa', new PresenceOfValidator([
            'message' => 'El campo local proyecto es requerido'
        ]));         

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