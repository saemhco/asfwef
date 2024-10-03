<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class AlumnosSemestre extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("alumnos_semestre");
    }



  
}
