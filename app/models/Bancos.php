    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Bancos extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_siaf_banco");
    }


}
