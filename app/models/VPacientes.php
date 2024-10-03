<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VPacientes extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_dss_pacientes");
    }


}
