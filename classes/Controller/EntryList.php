<?php

namespace Controller;

use Exception;
use Model\Factory;

class EntryList extends Base implements \Interfaces\Singleton {
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

    /**
     * @param array $aParams
     * @param array $template
     */
    public function get(array $aParams, array &$template) {

        $oFactory = new Factory();
        $oModel = $oFactory->createIterator();

        if (empty($aParams['query'])) {
            $aParams['query'] = '';
        }

        $results = $oModel->iterate($aParams['query']);

        $oModel->processEntries($results);

        $template = $results;
    }

}