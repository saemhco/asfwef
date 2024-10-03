<?php

use Phalcon\Mvc\Model;


class VSiriesDocentes extends Model {

    public function initialize() {
        $this->setSource('view_minedu_siries_docentes_2020');
    }

   

}
