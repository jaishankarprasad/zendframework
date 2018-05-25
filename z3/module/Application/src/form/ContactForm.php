<?php
namespace Application\Form;

// use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;

class ContactForm extends Form
{
	  public function __construct()
    {
        parent::__construct();

         

        

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
            'name' => 'subject',
             'type'  => 'Text',
               'attributes'=>[
              	'class'=>'form-control',
              ],
              'options' => [
               'label' => 'UserSubject',
            ],
            
             ]);

         $this->add([
            'name' => 'message',
             'type'  => Element\TextArea::class,
               'attributes'=>[
              	'class'=>'form-control',
              	'rows'=>5,
              	'cols'=>80,
              ],
              'options' => [
               'label' => 'Your message',
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
     }


}

?>
