    <?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class EncuestasRespuestasT extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_enc_encuestas_respuestast");
    }


}
