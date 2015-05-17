<?php

namespace Model;

use Helper\APCDetector;

class Factory {

    /**
     * @return CacheIteratorAPC
     */
    public function createIterator() {
        $sClass = '\\Model\\CacheIterator' . APCDetector::getInstance()->getApcMode();
        return new $sClass();
    }

} 