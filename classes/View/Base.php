<?php
namespace View;

abstract class Base implements \Interfaces\View {
	 
	protected $aParams = null;
	
	/**
	 * @param array $aParams
	 */
	public function __construct(array $aParams) {
		$this->aParams = $aParams;
	}
	
	public function get() {
		return '';
	}
	
}