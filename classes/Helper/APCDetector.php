<?php

namespace Helper;

use Exception;

class APCDetector {

    /**
     * @var APCDetector
     */
    private static $instance;

    private static $isApcAvailable;
    private static $isApcuAvailable;

    const APC_MODE_APC = 'APC';
    const APC_MODE_APCU = 'APCU';

    private function __construct()
    {
        self::$isApcAvailable = extension_loaded('apc');
        self::$isApcuAvailable = extension_loaded('apcu');
    }

    static public function getInstance()
    {

        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        if (empty(self::$instance)) {
            throw new Exception('APCDetector was unable to initiate');
        }

        return self::$instance;
    }

    public function isApcAvailable() {
        return self::$isApcAvailable || self::$isApcuAvailable;
    }

    public function getApcMode() {
        if (self::$isApcAvailable) {
            return self::APC_MODE_APC;
        } else {
            return self::APC_MODE_APCU;
        }
    }

} 