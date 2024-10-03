<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class DocentesSemestre extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("docentes_semestre");
    }




}
