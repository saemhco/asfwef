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
class Editoriales extends Model
{
 /**
     * @var integer
     */
 public $idioma_id;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("tbl_lib_editoriales");
    }

    public function validation() {
    	$validator = new Validation();

    	$validator->add(
    		'descripcion', new PresenceOfValidator([
    			'message' => 'El nombre de la editorial es requerido'
    		]));

    	return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
    	$messages = [];
    	foreach (parent::getMessages() as $message) {
    		$messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
    	}
    	return $messages;
    }
}
