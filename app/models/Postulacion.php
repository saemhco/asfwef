<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Postulacion extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("tbl_btr_postulaciones");
    }
}
