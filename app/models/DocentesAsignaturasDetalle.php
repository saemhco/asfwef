<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class DocentesAsignaturasDetalle extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("docentes_asignaturas_detalle");
    }




}
