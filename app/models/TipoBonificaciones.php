<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class TipoBonificaciones extends Model
{   
    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("a_codigos");
    }
}
