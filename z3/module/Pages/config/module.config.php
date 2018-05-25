<?php


namespace Pages;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;



return[
	'router'=>[
		 'routes' => [
            'page' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/page',
                    'defaults' => [
                        'controller' => Controller\PagesController::class,
                        'action'     => 'page',
                    ],

                ],
            ],
              
              'add' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/page/add',
                    'defaults' => [
                        'controller' => Controller\PagesController::class,
                        'action'     => 'add',
                    ],

                ],
            ],



               'update' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/page/update/:id',
                    'defaults' => [
                        'controller' => Controller\PagesController::class,
                        'action'     => 'update',
                    ],
                    'constraints'=>[
                            'id'=>'[0-9]\d*',
                    ],

                ],
            ],


             'delete' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/page/delete[/:id]',
                    'defaults' => [
                        'controller' => Controller\PagesController::class,
                        'action'     => 'delete',
                    ],
                     'constraints'=>[
                            'id'=>'[0-9]\d*',
                    ],

                ],
            ],




             






        ],
	],
	'controllers' => [
        'factories' => [
            Controller\PagesController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
    	    'template_map' => [
                 'layout/pageslayout'           => __DIR__ . '/../view/layout/layout.phtml',
                 'Pages/Pages/page' => __DIR__ . '/../view/Pages/Pages/page.phtml',
           
        ],
    	'template_path_stack' => [
            __DIR__ . '/../view',
        ],

    ],
	
	
];

?>