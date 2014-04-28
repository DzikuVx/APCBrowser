<?php

namespace Controller;

use Exception;
use General\Formater;
use Model\CacheEntry;
use Model\CacheIterator;

class Entry extends Base implements \Interfaces\Singleton {
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

        $oModel = new CacheEntry();

        $result = $oModel->get($aParams['key']);

        var_dump($result);

        $result['mtime'] = Formater::formatDateTime($result['mtime']);
        $result['atime'] = Formater::formatDateTime($result['atime']);
        $result['ctime'] = Formater::formatDateTime($result['ctime']);

        $template = $result;
    }

}