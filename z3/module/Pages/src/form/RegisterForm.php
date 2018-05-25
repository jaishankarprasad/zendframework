<?php
namespace Pages\Form;

// use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;


class RegisterForm extends Form
{
	    public function __construct(){
    
        parent::__construct();
        $inputFilter=new InputFilter();
        $this->setInputFilter($inputFilter);

        
       
            


            $this->add([
            'name' => 'name',
             'type'  => 'Text',
              'attributes'=>[
                'class'=>'form-control',
              ],
              'options' => [
               'label' => 'UserName',
            ],
            
             ]);

          $this->add([
            'name' => 'email',
             'type'  => Element\Email::class,
               'attributes'=>[
                'class'=>'form-control',
              ],
              'options' => [
               'label' => 'UserEmail',
            ],
            
             ]);



           $this->add([
            'name' => 'mobile',
             'type'  => 'Text',
              'attributes'=>[
                'class'=>'form-control',
              ],
              'options' => [
               'label' => 'UserMobile',
            ],
            
             ]);

         



           $this->add([
            'name' => 'security',
            'type'  => Element\Csrf::class,
            
        ]);

         $this->add([
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Submit',
                'class'=>'btn btn-success btn-block',
            ],
        ]);






      //Add input  filter for email foield ...................
         $inputFilter->add([


          'name'=>'email',
          'required'=> true,
          'filters'=>[
            ['name'=>'StringTrim'],
          ],
          'validatrors'=>[
           [
               'name'=>'EmailAddress',
               'options'=>[
                 'allow'=>'Validator\Hostname::ALLOW_DNS',
                 'useMxCheck'=> false,
               ],
           ],
          ],
          ]);




      $inputFilter->add([


          'name'=>'name',
          'required'=> true,
          'filters'=>[
            ['name'=>'StringTrim'],
          ],
          'validatrors'=>[
           [
               'name'=>'StringLength',
               'options'=>[
                 'min'=>4,
                 'max'=> 8,
               ],
           ],
          ],
          ]);





$inputFilter->add([


          'name'=>'mobile',
          'required'=> true,
          'filters'=>[
            ['name'=>'StringTrim'],
          ],
          'validatrors'=>[
           [
               'name'=>'StringLength',
               'options'=>[
                 'min'=>4,
                 'max'=> 10,
               ],
           ],
          ],
          ]);















 }       
    
 
}
?>