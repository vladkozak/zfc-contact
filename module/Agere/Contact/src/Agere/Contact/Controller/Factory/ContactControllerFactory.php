<?php
/**
 * Reader Controller Factory
 *
 * @category Agere
 * @package Agere_Reader
 * @author Kozak Vlad <vk@agere.com.ua>
 * @datetime: 16.05.2016 1:19
 */
namespace Agere\Contact\Controller\Factory;

use Agere\Contact\Controller\ContactController;

class ContactControllerFactory
{
    public function __invoke($cm)
    {
        $sm = $cm->getServiceLocator();
        $controller = new ContactController();
        $controller->setServiceManager($sm);

        return $controller;
    }
}
