    <?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
/**
 * Types of Products
 */
class AfpDetalle extends Model
{
 /**
    
    public $estado;

    /**
     * ProductTypes initializer
     */
    public function initialize() {
        $this->setSource("tbl_per_afp_detalles");
    }

    public function validation() {
        $validator = new Validation();


        $validator->add(
            'aporte', new PresenceOfValidator([
                'message' => 'El campo aporte es requerido'
            ]));

        $validator->add(
            'prima', new PresenceOfValidator([
                'message' => 'El campo prima es requerido'
            ]));

        $validator->add(
            'csr', new PresenceOfValidator([
                'message' => 'El campo csr es requerido'
            ]));

        $validator->add(
            'periodo', new PresenceOfValidator([
                'message' => 'El campo periodo es requerido'
            ]));

        return $this->validate($validator);
    }

    public function getMessages($filter = NULL) {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }

}
