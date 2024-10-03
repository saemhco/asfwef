    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Afp extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_per_afp");
    }


}
