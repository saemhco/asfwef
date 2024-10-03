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
class Categorias extends Model
{


    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("a_codigos");
    }

    public function validation() {
    	$validator = new Validation();

    	$validator->add(
    		'descripcion', new PresenceOfValidator([
    			'message' => 'El nombre de la categoria es requerido'
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
