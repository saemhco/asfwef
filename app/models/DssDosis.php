    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class DssDosis extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("a_codigos");
    }


}
