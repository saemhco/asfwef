<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

/**
 * Types of Products
 */
class PersonalMarcaciones extends Model
{

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->setSource("tbl_web_personal_marcaciones");
    }



    // public function validation() {
    //     $validator = new Validation();



    //     $validator->add(
    //         'fecha', new PresenceOfValidator([
    //             'message' => 'El campo fecha es requerido'
    //         ]));


    //     return $this->validate($validator);
    // }




    public function getMessages($filter = NULL)
    {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages["" . $message->getField()] = '<div class="text-danger errorforms">' . $message->getMessage() . '</div>';
        }
        return $messages;
    }
}
