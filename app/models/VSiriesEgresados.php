<?php

use Phalcon\Mvc\Model;


class VSiriesEgresados extends Model {

    public function initialize() {
        $this->setSource('view_minedu_siries_egresados_2020');
    }

   

}
