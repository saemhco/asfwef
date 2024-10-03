<?php

use Phalcon\Mvc\Model;


class VPrestamosLista extends Model {

    public function initialize() {
        $this->setSource('view_prestamos_lista');
    }
}