<?php

use Phalcon\Mvc\Model;


class VSiriesPostulantes extends Model {

    public function initialize() {
        $this->setSource('view_minedu_siries_postulantes_2020');
    }

   

}
