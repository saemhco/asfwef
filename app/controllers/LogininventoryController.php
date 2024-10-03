
<?php
class LogininventoryController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }
    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/logininventory.js?v" . uniqid());
    }
}

?>