<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class AmbientesA extends Model
{
    /**
     * @var string
     */
    public $numero;
    
        /**
     * @var string
     */
    public $codigo;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $nombres;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("ambientes");
    }

    public function validation() {
    	$validator = new Validation();

        $validator->add(
            'codigo', new PresenceOfValidator([
                'message' => 'El campo código es requerido'
            ]));


        $validator->add(
            'tipo', new PresenceOfValidator([
                'message' => 'El campo tipo es requerido'
            ]));


        return $this->validate($validator);
    }

    public function getMessages($filter=NULL) {
    	$messages = [];
    	foreach (parent::getMessages() as $message) {
    		$messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
    	}
    	return $messages;
    }
}
