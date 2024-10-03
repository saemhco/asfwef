<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class AlumnosAsignaturasPre extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("alumnos_asignaturas_pre");
    }




}
