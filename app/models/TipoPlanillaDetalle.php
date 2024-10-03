
<?php

use Phalcon\Mvc\Model;
/**
 * Types of Products
 */
class TipoPlanillaDetalle extends Model {

    
    public function initialize() {
        $this->setSource("tbl_per_planillas_tipo_config");
    }

}

// - remuneracion basica , INgresos
// - remuneracion bruta , 
// - input bloqueado

// aportaciones
// essalud -  
// ies     -
// sctr    -


// descuebtos -- 3 prim
// 4ta cat   [] -- tipo planilla  0
// 5ta cat   [] -- tipo planilla  0
// descto. judicial %   [] --det  0
// descto. judicial S/. [] --det  0