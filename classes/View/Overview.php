<?php

namespace View;

use General\Formater;
use General\Templater;

class Overview extends Base {

	protected $model = null;
	
	public function __construct(array $aParams) {
		parent::__construct($aParams);
		
		$this->model = new \Model\CacheIterator();
		
	}
	
	public function mainpage()
	{
		$oTemplate = new Templater('overview.html');



		return (string) $oTemplate;
	}
}