<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Zend\Form\Element;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Form\Factory;
use Zend\Hydrator\ArraySerializable;
use Application\Form\ContactForm;
use Zend\Db\Adapter\AdapterInterface;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
     public function aboutAction()
    {
        return new ViewModel();
    }
      public function contactAction()
    {
    	$form=new ContactForm();
    	
        return new ViewModel(['form'=>$form]);
    }
     public function processAction()
    {
    	$request=$this->getRequest();
    	 echo "<pre>";
    	 print_r($request->getPost());
    	 exit;

    }
}
