<?php
namespace Agere\Contact;

class Module {

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => str_replace('\\', '/', __DIR__ . '/src/' . __NAMESPACE__),
				),
			),
		);
	}


    // такого не роби, все винось у конфіг, анонімні функції заміняй на фабрики
    //ось таке знайшов наче від розробника Zendа

    /*public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'afterContent' => function($sm) {
                        $helper = new View\Helper\AfterContentHelper;
                        return $helper;
                    }
            )
        );
    }*/

}
