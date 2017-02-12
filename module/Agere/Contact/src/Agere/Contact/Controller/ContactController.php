<?php
/**
 * Created by PhpStorm.
 * User: Kozak Vlad
 * Date: 09.05.16
 * Time: 13:06
 */
namespace Agere\Contact\Controller;

use Agere\Core\Service\ServiceManagerAwareTrait;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Feed\Reader\Exception;
use Zend\View\Model\ViewModel;
use Agere\Contact\Form\ContactForm;

/**
 * Class StatusController
 *
 * @package Magere\Status
 * @method \Agere\Contact\Controller\Plugin\Mail mail()
 */
class ContactController extends AbstractActionController
{
    use ServiceManagerAwareTrait;

   // const GOOGLE_SECRET_RECAPCHA = '6LeByBkTAAAAAHl2RmH718yumqF5w8Jlvqq7Wxxj';
    const GOOGLE_SECRET_RECAPCHA = '6LfMzCETAAAAANXKEx2k2lU6dgnM4DdLSUtpuBCz'; //for Inform.dev

    public function mailAction()
    {
        $fm = $this->getServiceManager()->get('FormElementManager');
        $form = $fm->get(ContactForm::class);
        $request = $this->getRequest();
        $message = '';
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $servParam = $request->getServer();
                $postParam = $request->getPost();
                $recaptcha = new \ReCaptcha\ReCaptcha(self::GOOGLE_SECRET_RECAPCHA);
                $resp = $recaptcha->verify($postParam['g-recaptcha-response'], $servParam->REMOTE_ADDR);
                if ($resp->isSuccess()) {
                    $this->mail()->sendMail($request->getPost());
                    if ($request->isXmlHttpRequest()) {
                        $message = 'Письмо успешно отправлено';
                        $form = $fm->get(ContactForm::class);
                    }
                } else {
                    $message = 'Сообщение не прошло проверку, попробуйте еще раз';
                }
            }
        }

        return (new ViewModel([
            'form' => $form,
            'message' => $message
        ]))->setTemplate('template/contact/form')
            ->setTerminal($this->getRequest()->isXmlHttpRequest());
    }
}