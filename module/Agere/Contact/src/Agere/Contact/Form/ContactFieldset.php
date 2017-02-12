<?php

namespace Agere\Contact\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class ContactFieldset extends Fieldset implements InputFilterProviderInterface, ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function init()
    {
        $this->setName('contact');
        $this->add(
            [
                'name' => 'firstName',
                'type' => 'text',
                'attributes' => [
                    //'placeholder' => _('First Name'),
                    'placeholder' => _('Имя'),
                    'class' => 'form-control',
                    'id' => 'input-username',
                ],
            ]
        );
        $this->add(
            [
                'name' => 'email',
                'type' => 'text',
                'attributes' => [
                    'placeholder' => _('Email'),
                    'class' => 'form-control',
                    'id' => 'input-username',
                ],
            ]
        );
        $this->add(
            [
                'name' => 'lastName',
                'type' => 'text',
                'attributes' => [
                    //'placeholder' => _('Last Name'),
                    'placeholder' => _('Фамилия'),
                    'class' => 'form-control ',
                    'id' => 'input-username',
                    'autocomplete' => "off",
                    'required' => false,
                    'autofocus',
                ],
            ]
        );
        $this->add(
            [
                'name' => 'phone',
                'type' => 'text',
                'attributes' => [
                    //'placeholder' => _('Phone format: 0981578565 or 380684565786'),
                    'placeholder' => _('Формат номера: 0981578565'),
                    'class' => 'form-control',
                    'id' => 'input-username',
                    'autocomplete' => "off",
                    'required' => false,
                    'autofocus',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'text',
                'type' => 'textarea',
                'attributes' => [
                    //'placeholder' => _('Text'),
                    'placeholder' => _('Сообщение'),
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ]
        );

    }

    public function getInputFilterSpecification()
    {
        return [
            'firstName' => [
                'required' => true,
            ],
            'email' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    ['name' => 'EmailAddress'],
                ],
            ],
            'phone' => [
                'required' => false,
                'filters' => [
                    ['name' => 'stringtrim'],
                    [
                        'name' => 'Callback',
                        'options' => [
                            'callback' => function ($value) {
                                    if (null === $value) {
                                        return null;
                                    }
                                    $value = preg_replace('/[^0-9,]|,[0-9]*$/', '', $value);

                                    return $value;
                                }
                        ]
                    ]
                ],
                'validators' => [
                    [
                        'name' => 'Digits',
                        'break_chain_on_failure' => true,
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 10,
                            'max' => 12,
                        ],
                    ],
                ],
            ],
        ];
    }
}