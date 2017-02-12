<?php
namespace Agere\Contact\Form;

use Zend\Form\Form;

class ContactForm extends Form
{
    protected $objectManager;

    public function init()
    {
        $this->setName('contact');
        $this->add(
            [
                'name' => 'contact',
                'type' => 'Agere\Contact\Form\ContactFieldset',
                'options' => [
                    'use_as_base_fieldset' => true,
                ],
            ]
        );
        $this->add(
            [
                'name' => 'button',
                'attributes' => [
                    'type' => 'button',
                    'value' => 'Отправить',
                    'class' => 'show-more',
                ],
            ]
        );

    }
}