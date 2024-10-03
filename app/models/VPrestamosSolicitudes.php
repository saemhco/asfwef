<?php

use Phalcon\Mvc\Model;


class VPrestamosSolicitudes extends Model {

    public function initialize() {
        $this->setSource('view_prestamos_solicitudes');
    }
}