<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VNotas extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_notas_ga");
    }


}
