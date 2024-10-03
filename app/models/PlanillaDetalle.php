<?php

use Phalcon\Mvc\Model;


/**
 * Types of Products
 */
class PlanillaDetalle extends Model
{


    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
    	$this->setSource("tbl_per_planillas_detalle");
    }


    




}
