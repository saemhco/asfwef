<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VAlumnosSemestre extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_alumnos_semestre");
    }


}
