<?php

namespace Translate;
use phpCache\CacheKey;
use phpCache\Factory;

/**
 *
 * @author Paweł
 */
class Translate implements \ArrayAccess {

	private $language;
	private $table;

	/**
	 * Czy klasa ma prowadzić cache plików
	 * @var boolean
	 */
	static public $useCache = false;

	/**
	 * Konstruktor
	 * @param string $language
	 * @param string $file
	 */
	public function __construct($language, $file = 'translations.php') {
		$this->language = $language;

        /** @noinspection PhpIncludeInspection */
        require dirname ( __FILE__ ).'/../../translations/'.$file;

        /** @noinspection PhpUndefinedVariableInspection */
        $this->table = $translationTable[$this->language];
        unset ( $translationTable );
	}

	/**
	 * Pobranie tłumaczenia
	 *
	 * @param string $string
	 * @return string
	 */
	function get($string) {

		if (isset ( $this->table [$string] )) {
			return $this->table [$string];
		} else {
			return $string;
		}
	}

	public function offsetSet($offset, $value) {
		$this->table[$offset] = $value;
	}

	public function offsetExists($offset) {
		return isset($this->table[$offset]);
	}

	public function offsetUnset($offset) {
		unset($this->table[$offset]);
	}

	public function offsetGet($offset) {

		if (isset($this->table[$offset])) {
			return $this->table[$offset];
		}else {
			return false;
		}

	}

}