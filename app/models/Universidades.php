    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Universidades extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_web_universidades");
    }


}
