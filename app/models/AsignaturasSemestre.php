<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class AsignaturasSemestre extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("asignaturas_semestre");
    }




}
