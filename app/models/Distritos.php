<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Distritos extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $descripcion;


    /**
     * @var string
     */
    public $url;



    /**
     * @var string
     */ 
    public $provincia_id;



    /**
     * @var string
    */
    public $estado;



    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("distritos");
    }
}
