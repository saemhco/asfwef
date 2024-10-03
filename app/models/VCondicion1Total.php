    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VCondicion1Total extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("view_lic_condicion1_total");
    }


}
