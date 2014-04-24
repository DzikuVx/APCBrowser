<?php

namespace Controller;

use Exception;
use General\Formater;
use Model\CacheIterator;

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
     * @param $results
     */
    private function processEntries(&$results) {

        foreach ($results as &$result) {
            $result['mtime'] = Formater::formatDateTime($result['mtime']);
            $result['atime'] = Formater::formatDateTime($result['atime']);
            $result['ctime'] = Formater::formatDateTime($result['ctime']);
        }

    }

    /**
     * @param array $aParams
     * @param array $template
     */
    public function get(array $aParams, array &$template) {

        $oModel = new CacheIterator();

        if (empty($aParams['query'])) {
            $aParams['query'] = '';
        }

        $results = $oModel->iterate($aParams['query']);

        $this->processEntries($results);

        $template = $results;
    }

}