<?php

namespace Model;

use General\Formater;

class CacheIteratorAPCU extends Base implements \Interfaces\Model {

	public function iterate($query = '', $bWithValue = false) {

        //TODO add regexp to get only some

        $oIterator = new \APCIterator("");

        $aRetVal = array();

        while ($current = $oIterator->current()) {
            if (!$bWithValue) {
                unset($current['value']);
            }
            $aRetVal[] = $current;
            $oIterator->next();
        }

        return $aRetVal;
    }

    public function processEntries(&$results) {

        foreach ($results as &$result) {
            $result['mtime'] = Formater::formatDateTime($result['mtime']);
            $result['atime'] = Formater::formatDateTime($result['atime']);
            $result['ctime'] = Formater::formatDateTime($result['ctime']);
        }

    }

}