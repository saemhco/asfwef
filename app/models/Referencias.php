<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class Referencias extends Model {

  

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_doc_referencia");
    }

}
