<?php
/**
 * Created by PhpStorm.
 * User: ruslana
 * Date: 08.06.16
 * Time: 20:35
 */
namespace Agere\Contact\Controller\Plugin;

use Zend\Stdlib\Exception;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Mail extends AbstractPlugin
{
    protected $config;

    public function injectConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function sendMail($request)
    {
        $config = $this->config;

        $email = $config['email'];
        $body = $this->getBody($request);

        $message = new Message();
        $message->setFrom($email['from']) 
            ->addTo($email['to'])
            ->setSubject($email['subject'])
            ->setBody($body)
            ->setEncoding('UTF-8');

        $smtp = $config['smtp'];

        //$transport = \Zend\Mail\Transport\Factory::create(['type' => 'smtp', 'options' => $smtp]);

        $transport = new SendmailTransport();
        $transport->send($message);
    }


    public function getBody($request) {

        /*@todo реалізувати нормальний шаблон для відправки листів*/

        return $body = "Із сайту inform-ua.info прийшло звернення:
                    Ім'я: {$request['contact']['firstName']}
                    Прізвище: {$request['contact']['lastName']}
                    Телефон: {$request['contact']['phone']}
                    Email: {$request['contact']['email']}
                    Повідомлення: {$request['contact']['text']}";

    }
}