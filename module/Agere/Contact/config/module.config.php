<?php

namespace Agere\Contact;

return [

    'email' => [
        'from' => 'support@melny.in', // це не змінювати
        'to' => [
            'support@agere.com.ua',
            'info@inform-ua.info',

        ],
        'subject' => 'Зворотній зв\'язок із сайту inform-ua.info'
    ],

    'router' => [
        'routes' => [
            'mail' => [
                'type' => 'segment',
                'options' => [
                    'route'    => '/mail',
                    'defaults' => [
                        'controller' => Controller\ContactController::class,
                        'action'     => 'mail',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'aliases' => [
            'contact' => Controller\ContactController::class,
        ],
        'factories' => [
            Controller\ContactController::class => Controller\Factory\ContactControllerFactory::class,
        ],
    ],

    'controller_plugins' => [
        'aliases' => [
            'mail' => Controller\Plugin\Mail::class,
        ],
        'factories' => [
            Controller\Plugin\Mail::class => Controller\Plugin\Factory\MailFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],

        'template_map' => [
            'template/contact/form'  => __DIR__ . '/../view/agere/form/partial/contact-form.phtml',
        ]
    ],

    'view_helpers' => [
        'invokables'=> [
            'afterContent' => View\Helper\AfterContentHelper::class,
        ]
    ],



];