<?php
/**
 * Mail plugin factory
 *
 * @category Agere
 * @package Agere_Contact
 * @author Kozak Vlad
 * @datetime: 11.06.16 16:20
 */
namespace Agere\Contact\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Agere\Contact\Controller\Plugin\Mail;

class MailFactory
{
    public function __invoke(ServiceLocatorInterface $cpm)
    {
        $sm = $cpm->getServiceLocator();
        $config = $sm->get('config');

        return (new Mail())
            ->injectConfig($config);
    }
}