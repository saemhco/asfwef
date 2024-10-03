<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Concentraciones extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("a_codigos");
    }


}
