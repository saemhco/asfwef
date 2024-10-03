<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Regiones extends Model
{   
    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("regiones");
    }
}
