<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VAsistenciaDetalles extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize() {
    	$this->setSource("view_asistencia_detalles");
    }


}
