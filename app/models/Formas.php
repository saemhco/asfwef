<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Formas extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("a_codigos");
    }


}
