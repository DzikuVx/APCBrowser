<?php
namespace Controller;

use Exception;
use \General\CustomException as CustomException;
use General\Debug;
use Interfaces\Singleton;
use Listeners\LowLevelMessage;
use Listeners\Message;

class Main extends Base implements Singleton {

	private static $instance;

	private $aParams = array();
	
	private function __construct() {
		$this->aParams = $_REQUEST;
	}

	/**
	 * @throws Exception
	 */
	static public function getInstance() {

		if (empty(self::$instance)) {
			self::$instance = new self();
		}

		if (empty(self::$instance)) {
			throw new Exception('Main Controller was unable to initiate');
		}

		return self::$instance;
	}

	/**
	 * @return string
	 */
	public function get() {

        /**
         * @var \General\Templater
         */
        $template = new \General\Templater('index.html');

		try {

			Message::getInstance()->register($this->aParams, $template);

			if (empty ( $this->aParams ['class'] )) {
				$this->aParams ['class'] = 'Overview';
			}

			if (empty ( $this->aParams ['method'] )) {
				$this->aParams ['method'] = 'render';
			}

			switch ($this->aParams ['class']) {

				default:
					$className = '\\Controller\\'.$this->aParams ['class'];
					break;
			}

			switch ($this->aParams ['method']) {

				default :
					$methodName = $this->aParams ['method'];
					break;

			}

			if (class_exists($className)) {

                /** @noinspection PhpUndefinedMethodInspection */
                $tObject = $className::getInstance();

				if (method_exists($tObject, $methodName)) {
					$tObject->{$methodName}($this->aParams, $template);
				}
			}

			LowLevelMessage::getInstance()->register($this->aParams, $template);
		}
		catch ( CustomException $e ) {
			$template->add('mainContent', Debug::cThrow ( $e->getMessage (), $e, array ('send' => false, 'display' => false ) ));
		}
		catch ( Exception $e ) {
			$template->add('mainContent', Debug::cThrow ( null, $e ));
		}

		$template->add('listeners', '');
		$template->add('menu', '');
		$template->add('mainContent', '');
		$template->add('pageTitle', '{T:Project Name}');
		
		$sHtml = (string) $template;
		
		/*
		 * Remove all menu-active-* occurences
		 */
		$sHtml = preg_replace('!({submenu-active-[^}]*})!', '', $sHtml);
		$sHtml = preg_replace('!({menu-active-[^}]*})!', '', $sHtml);
		
		/*
		 * Add params
		 */
		$sHtml = preg_replace_callback('!({params:[^}]*})!', array($this, 'paramsInjecter'), $sHtml);
		
		
		return $sHtml;

	}

	private function paramsInjecter($matches)
	{
	
		$retval = $matches [1];
		$retval = mb_substr($retval, 8, - 1);
	
		if (isset($this->aParams[$retval])) {
			$retval = $this->aParams[$retval];
		}else {
			$retval = '';
		}
		
		return $retval;
	}
	
}