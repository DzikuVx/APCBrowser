<?php

namespace View;

use General\Formater;
use General\Templater;
use Model\Factory;

class Overview extends Base {

	protected $model = null;
	
	public function __construct(array $aParams) {
		parent::__construct($aParams);

        $oFactory = new Factory();

		$this->model = $oFactory->createIterator();
	}
	
	public function mainpage()
	{
		$oTemplate = new Templater('overview.html');

		return (string) $oTemplate;
	}
}