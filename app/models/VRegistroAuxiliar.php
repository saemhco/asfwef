<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VRegistroAuxiliar extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_registro_auxiliar");
    }


}
