<?php

namespace Controller;

use Exception;

class Overview extends Base implements \Interfaces\Singleton {

	private static $instance;

	private function __construct()
	{

	}

	static public function getInstance()
	{

		if (empty(self::$instance)) {
			self::$instance = new self();
		}

		if (empty(self::$instance)) {
			throw new Exception('Controller was unable to initiate');
		}

		return self::$instance;
	}

	public function render(array $aParams, \General\Templater $template) {
		$oView = new \View\Overview($aParams);
		$template->add('menu-active-overview','active');

		$template->add('mainContent', $oView->mainpage());
	}
}