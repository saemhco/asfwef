<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VDssPacientes extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_dss_pacientes");
    }


}
