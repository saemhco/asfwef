    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class SiafTipoRecursos extends Model
{
 /**
    
    

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_siaf_tipo_recurso");
    }


}
