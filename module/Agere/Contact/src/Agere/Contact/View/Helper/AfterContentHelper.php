<?php
/**
 * Created by PhpStorm.
 * User: Vlad Kozak
 * Date: 06.06.16
 * Time: 19:11
 */
namespace Agere\Contact\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Agere\Contact\Form\ContactForm;

class AfterContentHelper extends AbstractHelper
{
    protected $templates = [
        'kontakt' => 'template/contact/form'
    ];

    protected $route;

    public function __invoke($route = null )
    {
        if ($route) {
            if (in_array($route, array_keys($this->templates))) {
                $this->route = $route;
            }
        }

        return $this;
    }

    public function render()
    {
        $sm = $this->getView()->getHelperPluginManager()->getServiceLocator();
        $fm = $sm->get('FormElementManager');
        $form = $fm->get(ContactForm::class);
        if (isset($this->route)) {
            $template = $this->templates[$this->route];

            return $this->getView()->partial($template, ['form' => $form]);
        }
    }
}