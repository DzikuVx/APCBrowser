<?php
namespace Controller;

use Exception;
use Interfaces\Singleton;

class Api extends Base implements Singleton {

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
            throw new Exception('API Controller was unable to initiate');
        }

        return self::$instance;
    }

    public function get() {

        /**
         * @var \General\Templater
         */
        $template = array();

        if (empty($this->aParams['controller'])) {
            throw new Exception('Controller not specified');
        }

        if (empty ( $this->aParams ['action'] )) {
            $this->aParams ['action'] = 'get';
        }

        switch ($this->aParams ['controller']) {

            default:
                $className = '\\Controller\\'.$this->aParams ['controller'];
                break;
        }

        switch ($this->aParams ['action']) {

            default :
                $methodName = $this->aParams ['action'];
                break;

        }

        if (class_exists($className)) {

            /** @noinspection PhpUndefinedMethodInspection */
            $tObject = $className::getInstance();

            if (method_exists($tObject, $methodName)) {
                $tObject->{$methodName}($this->aParams, $template);
            } else {
                throw new Exception('Action does not exists');
            }
        } else {
            throw new Exception('Controller does not exists');
        }

        return json_encode($template);
    }

} 