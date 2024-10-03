<?php

use Phalcon\Mvc\Model;


class VPrestamosConfirmados extends Model {

    public function initialize() {
        $this->setSource('view_prestamos_confirmados');
    }

   

}