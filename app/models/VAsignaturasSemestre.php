<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VAsignaturasSemestre extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_asignaturas_semestre");
    }


}
