<?php
namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    public function registerAction()
    {
        return new ViewModel();
    }
}
