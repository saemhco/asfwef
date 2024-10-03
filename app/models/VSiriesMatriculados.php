<?php

use Phalcon\Mvc\Model;


class VSiriesMatriculados extends Model {

    public function initialize() {
        $this->setSource('view_minedu_siries_matriculados_2020');
    }

   

}
