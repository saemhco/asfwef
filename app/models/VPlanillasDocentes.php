    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class VPlanillasDocentes extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("view_planillas_docentes");
    }


}
