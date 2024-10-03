    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class SiafFuenteFinanciamiento extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_log_fuente_financ");
    }


}
