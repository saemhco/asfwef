    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class SiafRubros extends Model
{
 /**
    
    

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_log_rubros");
    }


}
