<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Provincias extends Model
{   
    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("provincias");
    }
}
