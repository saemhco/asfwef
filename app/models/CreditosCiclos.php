<?php

use Phalcon\Mvc\Model;


/**
 * Types of Products
 */
class CreditosCiclos extends Model {
    
    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("creditos_ciclo");
    }



}
